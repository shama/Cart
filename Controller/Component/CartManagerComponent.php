<?php
App::uses('Component', 'Controller');
App::uses('CartSessionComponent', 'Cart.Controller/Component');
App::uses('CakeEvent', 'Event');
/**
 * CartManagerComponent
 *
 * This component cares just and only about the cart contents. It will add
 * and remove items from the active cart but nothing more.
 * 
 * The component will make sure that the cart content in the sessio and database
 * is always the same and gets merged when a user is not logged in and then logs in.
 *
 * It also can store the cart for non logged in users semi-persistant in a cookie.
 *
 * Checking a cart out and dealing with other stuff is not the purpose of this 
 * component.
 *
 * @author Florian Krämer
 * @copyright Florian Krämer
 * @license MIT
 */
class CartManagerComponent extends Component {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'Cart.CartSession');

/**
 * Default settings
 * - model 
 * - buyAction the controller action to use or check for
 * - cartModel 
 * - sessionKey 
 * - useCookie 
 * - cookieName 
 * - afterBuyRedirect
 *   - false to disable it
 *   - null to use the referer
 *   - string or array to set a redirect url
 * - getBuy boolean enable/disable capture of buy data via get
 * - postBuy boolean enable/disable capture of buy data via post
 *
 * @var array
 */
	protected $_defaultSettings = array(
		'model' => null,
		'buyAction' => 'buy',
		'cartModel' => 'Cart.Cart',
		'sessionKey' => 'Cart',
		'useCookie' => false,
		'cookieName' => 'Cart',
		'afterBuyRedirect' => null,
		'getBuy' => true,
		'postBuy' => true);

/**
 * User status if logged in or not
 *
 * @var boolean
 */
	public $loggedIn = false;

/**
 * Default settings
 *
 * @var array
 */
	public function initialize(Controller $Controller, $settings = array()) {
		$this->settings = array_merge($this->_defaultSettings, $settings);
		$this->Controller = $Controller;

		if (empty($this->settings['model'])) {
			$this->settings['model'] = $this->Controller->modelClass;
		}

		$this->sessionKey = $this->settings['sessionKey'];

		if ($this->Controller->Auth->user()) {
			$this->isLoggedIn = true;
		}

		$this->initalizeCart();
	}

/**
 * Initializes the cart data from session or database depending on if user is logged in or not and if the cart is present or not
 *
 * @return void
 */
	public function initalizeCart() {
		extract($this->settings);
		$userId = $this->Auth->user('id');
		$this->CartModel = ClassRegistry::init($cartModel);

		if (!$this->Session->check($sessionKey)) {
			if ($userId) {
				$this->Session->write($sessionKey, $this->CartModel->getActive($userId));
			} else {
				$this->Session->write($sessionKey, array(
					'Cart' => array(),
					'CartsItem'));
			}
		} else {
			if ($userId && !$this->Session->check($sessionKey . '.Cart.id')) {
				$this->Session->write($sessionKey, $this->CartModel->getActive($userId));
			}
		}
		$this->cartId = $this->Session->read($sessionKey . '.Cart.id');
	}

/**
 * Component startup callback
 *
 * @return void
 */
	public function startup() {
		extract($this->settings);
		if ($this->Controller->action == $buyAction && !method_exists($this->Controller, $buyAction)) {
			$this->captureBuy();
		}
	}

/**
 * Captures a buy from a post or get request
 *
 * @return mixed False if the catpure failed array with item data on success
 */
	public function captureBuy() {
		extract($this->settings);
		if ($this->Controller->request->is('get')) {
			$data = $this->getBuy();
		}

		if ($this->Controller->request->is('post')) {
			$data = $this->postBuy();
		}

		if (!$data) {
			return false;
		}

		$data = $this->_additionalData($data);

		if ($this->Controller->{$model}->isBuyable($data)) {
			$item = $this->addItem($data);
			if ($item) {
				if ($this->Controller->request->is('ajax')) {
					$this->Controller->set('item', $item);
					$this->Controller->render($buyAction);
				} else {
					$this->afterBuyRedirect($item);
				}
			}
			return $item;
		}
		return false;
	}

/**
 * Adds additional data here to avoid code duplication in getBuy() and postBuy()
 *
 * @param array $data
 * @return array
 */
	protected function _additionalData($data) {
		$data['CartsItem']['user_id'] = $this->Auth->user('id');
		$data['CartsItem']['cart_id'] = $this->Session->read('Cart.Cart.id');

		if (!isset($data['CartsItem']['model'])) {
			$data['CartsItem']['model'] = get_class($this->Controller->{$model});
		}
		if (empty($data['CartsItem']['quantity'])) {
			$data['CartsItem']['quantity'] = 1;
		}
		return $data;
	}

/**
 * afterBuyRedirect
 *
 * @param array $item
 * @return vodi
 */
	public function afterBuyRedirect($item) {
		extract($this->settings);
		$this->Session->setFlash(__d('cart', 'You added %s to your cart', $item['name']));
		if (is_string($afterBuyRedirect) || is_array($afterBuyRedirect)) {
			$this->Controller->redirect($afterBuyRedirect);
		} elseif (is_null($afterBuyRedirect)) {
			$this->Controller->redirect($this->Controller->referer());
		}
	}

/**
 * Handles the buy process of an item via a http get request and url parameters
 *
 * @return mixed false or array
 */
	public function getBuy() {
		if ($this->Controller->request->is('get') && isset($this->Controller->request->params['named']['item'])) {
			$data = array(
				'CartsItem' => array(
					'foreign_key' => $this->Controller->request->params['named']['item'],
					'model' => get_class($this->Controller->{$model})));

			if (isset($this->Controller->request->params['named']['quantity'])) {
				$data['CartsItem']['quantity'] = $this->Controller->request->params['named']['quantity'];
			}
			return $data;
		}
		return false;
	}

/**
 * Handels the buy process of an item via http post request
 *
 * @return mixed false or array
 */
	public function postBuy() {
		if ($this->Controller->request->is('post')) {
			$data = $this->Controller->request->data;
			return $data;
		}
		return false;
	}

/**
 * Adds an item to the cart, the session and database if a user is logged in
 *
 * @param array $data
 * @return boolean
 */
	public function addItem($data) {
		extract($this->settings);
		$data = $this->Controller->{$model}->beforeAddToCart($data);
		if ($this->isLoggedIn) {
			$data = $this->CartModel->addItem($this->cartId, $data);
		}
		$result = $this->CartSession->addItem($data);
		$this->calculateCart();
		return $result;
	}

/**
 * Drops all items and re-initializes the cart
 *
 * @param array $data
 * @return void
 */
	public function dropCart($data) {
		if ($this->isLoggedIn) {
			$this->CartModel->dropCart($this->cartId);
		}
		$result = $this->CartSession->dropCart($data);

		$this->initalizeCart();
		return $result;
	}

/**
 * Removes an item from the cart session and if a user is logged in from the database
 *
 * @param array $data
 * @return boolean
 */
	public function removeItem($data = null) {
		extract($this->settings);
		if ($this->isLoggedIn) {
			$this->CartModel->removeItem($this->cartId, $data);
		}
		$result = $this->CartSession->removeItem($data);
		$this->calculateCart();
		return $result;
	}

/**
 * Cart content
 *
 * 
 */
	public function content() {
		$this->calculateCart();
		return $this->Session->read($this->settings['sessionKey']);
	}

/**
 * @todo finish me
 */
	public function calculateCart() {
		$sessionKey = $this->settings['sessionKey'];
		$cartData = $this->CartModel->calculateCart($this->Session->read($sessionKey));
		if ($this->isLoggedIn) {
			//@todo save cart data here to db or in the model? :/
			//$this->CartModel->saveAll($cartData);
		}
		$this->Session->write($sessionKey, $cartData);
	}

/**
 * Stores the whole cart in a cookie
 *
 * Use this in the case the user is not logged in to make it semi-persistant
 *
 * @return boolean
 */
	public function writeCookie() {
		return $this->Cookie->write($this->settings['cookieName'], $this->content());
	}

/**
 * Used to restore a cart from a cookie
 * 
 * Use this in the case the user was not logged in and left the page for a longer time
 *
 * @return boolean true on success
 */
	public function restoreFromCookie() {
		$result = $this->Cookie->read($this->settings['cookieName']);
		$this->Controller->Session->write($this->settings['sessionKey'], $result);
	}

/**
 * afterFilter callback
 *
 * @return void
 */
	public function afterFilter() {
		if ($this->settings['useCookie']) {
			$this->writeCookie();
		}
	}

}