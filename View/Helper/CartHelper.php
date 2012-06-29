<?php
App::uses('AppHelper', 'View/Helper');
/**
 * CartHelper
 *
 * @author Florian Krämer
 */
class CartHelper extends AppHelper {
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session');

/**
 * 
 */
	public $iterator = 0;

/**
 * Composite list of item id and model of items that are in the cart session
 *
 * @var array
 */
	protected $_itemsInCart = array();

/**
 * @param View $View the view object the helper is attached to.
 * @param array $settings Array of settings.
 * @throws CakeException When the AjaxProvider helper does not implement a link method.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);

		if (empty($this->_itemsInCart) && $this->Session->check('Cart.CartsItem')) {
			$items = $this->Session->read('Cart.CartsItem');
			$this->_itemsInCart = array();
			foreach ($items as $item) {
				$this->_itemsInCart[] = $item['foreign_key'] . '-' . $item['model'];
			}
		}
	}

/**
 * Checks if an item exists in the cart session
 *
 * @param string $id
 * @param string $model 
 */
	public function inCart($id, $model = '') {
		$item = $item['foreign_key'] . '-' . $item['model'];
		return in_array($item, $this->_itemsInCart);
	}

	public function multiInput($id, $model = '') {
		$string = $this->Form->input('Cart.' . $this->iterator . '.quantity', array(
			'type' => 'text',
			'label' => false,
			'default' => 1));
		$string .= $this->Form->hidden('Cart.' . $this->iterator . '.Model', array(
			'value' => $model));
		$string .= $this->Form->hidden('Cart.' . $this->iterator . '.foreign_key', array(
			'value' => $id));
		$this->iterator++;
		return $string;
	}

	public function link($title, $url = array(), $options = array()) {
		$urlDefaults = array(
			'controller' => $this->params['controller'],
			'action' => 'buy');
		$optionDefaults = array(
			'class' => 'buy-link');
		$url = Set::merge($urlDefaults, $url);
		$options = Set::merge($optionDefaults, $options);
		return $this->Html->link($title, $url, $options);
	}

/**
 * 
 */
	public function reset() {
		$this->iterator = 0;
	}

/**
 * Returns the count of items in the current cart (session)
 *
 * @return integer
 */
	public function count() {
		return count($this->_itemsInCart);
	}

}