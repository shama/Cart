<?php
App::uses('Component', 'Controller');
/**
 * Cart Session Component
 *
 * This is intentionally separated from the Cart Manager to keep the code logically separated.
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 */
class CartSessionComponent extends Component {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Session');

/**
 * Cart session key
 *
 * @var string
 */
	public $sessionKey = 'Cart';

/**
 * Initializes the component
 *
 * @param Controller $controller
 * @param array $settings
 * @return void
 */
	public function initialize(Controller $Controller, $settings = array()) {
		$this->Controller = $Controller;
	}

/**
 * Adds an item to the cart or updates an existing item
 *
 * @param array
 * @return boolean
 */
	public function addItem($item) {
		if (!isset($item['foreign_key']) || !isset($item['model'])) {
			return false;
		}

		$arrayKey = $this->_findItem($item['foreign_key'], $item['model']);
		if ($arrayKey === false) {
			$cart = $this->Session->read($this->sessionKey . '.CartsItem');
			$cart[] = $item;
			$this->Session->write($this->sessionKey . '.CartsItem', $cart);
			return $item;
		} else {
			$this->Session->write($this->sessionKey . '.CartsItem.' . $arrayKey, $item);
			return $item;
		}
		return false;
	}

/**
 * Removes an item from the cart session
 *
 * @param array
 * @return boolean
 */
	public function removeItem($item) {
		if (!isset($item['foreign_key']) || !isset($item['model'])) {
			return false;
		}

		$arrayKey = $this->_findItem($item['foreign_key'], $item['model']);
		if ($arrayKey === false) {
			return false;
		}
		return $this->Session->delete($this->sessionKey . '.CartsItem.' . $arrayKey);
	}

/**
 * Checks if an item already is in the cart and if yes returns the array key
 *
 * @param 
 * @param 
 * @return mixed
 */
	protected function _findItem($id, $model) {
		$cart = $this->read();
		if (!empty($cart['CartsItem'])) {
			foreach ($cart['CartsItem'] as $key => $item) {
				if ($item['foreign_key'] == $id && $item['model'] == $model) {
					return $key;
				}
			}
		}
		return false;
	}

/**
 * Reads from the cart session
 *
 * @param string
 * @return mixed
 */
	public function read($key = '') {
		return $this->Session->read($this->sessionKey);
	}

/**
 * Write to the cart session
 *
 * @param 
 * @param 
 * @return 
 */
	public function write($key = '', $data = null) {
		if (!empty($key)) {
			$key = '.' . $key;
		}
		return $this->Session->write($this->sessionKey . $key, $data);
	}

/**
 * Drops the cart data from the session
 *
 * @return boolean
 */
	public function dropCart() {
		return $this->Session->delete($this->sessionKey);
	}
}