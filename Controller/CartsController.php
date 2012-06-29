<?php
App::uses('CartAppController', 'Cart.Controller');
App::uses('CakeEventManager', 'Event');
App::uses('CakeEvent', 'Event');
/**
 * Carts Controller
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 */
class CartsController extends CartAppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Cart.CartManager',
		'Session');

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'remove_item', 'checkout', 'callback');
	}

/**
 * Display all carts a user has, active one first
 *
 * @return void
 */
	public function index() {
		$this->paginate = array(
			'contain' => array(),
			'order' => array('Cart.active DESC'),
			'conditions' => array(
				'Cart.user_id' => $this->Auth->user('id')));
		$this->set('carts', $this->paginate());
	}

/**
 * Shows a cart for a user
 *
 * @param
 * @return void
 */
	public function view($cartId = null) {
		if (!empty($this->request->data)) {
			//debug($this->request->data);
		}
		$this->set('cart', $this->CartManager->content());
	}

/**
 * Removes an item from the cart
 */
	public function remove_item() {
		if (!isset($this->request->named['model']) || !isset($this->request->named['id'])) {
			$this->Session->setFlash(__d('cart', 'Invalid cart item'));
			$this->redirect($this->referer());
		}

		$result = $this->CartManager->removeItem(array(
			'foreign_key' => $this->request->named['id'],
			'model' => $this->request->named['model']));

		if ($result) {
			$this->Session->setFlash(__d('cart', 'Item removed'));
		} else {
			$this->Session->setFlash(__d('cart', 'Could not remove item'));
		}

		$this->redirect($this->referer());
	}

/**
 * Default callback entry point for API callbacks for payment processors
 *
 * @param string $processor
 * @return void
 */
	public function callback($processor = Null, $action = null) {
		$this->log($_POST, 'cart-callback');
		$this->log($_GET, 'cart-callback');

		// @todo check for valid processor?
		if (empty($processor)) {
			$this->cakeError(404);
		}

		CakeEventManager::dispatch(new CakeEvent('Carts.callback', $this, array($this->CartManager->content(), $action)));
		CakeEventManager::dispatch(new CakeEvent('Payment.' . $action, $this, array($this->CartManager->content())));
	}

/**
 * Triggers the checkout
 *
 * @param 
 * @return void
 */
	public function checkout($processor, $action = Null) {
		if (!class_exists(Inflector::classify($processor) . 'Processor')) {
			$this->Session->setFlash(__('Invalid payment method!'));
			$this->redirect(array('action' => 'view'));
		}

		$this->__anonymousCheckoutIsAllowed();

		$cartData = $this->CartManager->content();
		if (empty($cartData['CartsItem'])) {
			$this->Session->setFlash(__d('cart', 'Your cart is empty.'));
			$this->redirect(array('action' => 'view'));
		}
		CakeEventManager::dispatch(new CakeEvent('Carts.checkout', $this, array($cartData, $action)));
	}

/**
 * Last step for so called express checkout processors
 *
 * @return void
 */
	public function confirm_checkout($processor, $token) {
		if ($this->Cart->confirmCheckout($this->data)) {
			CakeEventManager::dispatch(new CakeEvent('Carts.confirmCheckout', $this, array()));
		}
		$this->set('cart', $this->CartManager->content());
	}

/**
 * __allowAnonymousCheckout
 *
 * @param boolean $redirect
 * @return boolean
 */
	protected function __anonymousCheckoutIsAllowed($redirect = true) {
		if (Configure::read('Cart.anonymousCheckout') === false && is_null($this->Auth->user())) {#
			$this->Session->setFlash(__d('cart', 'Sorry, but you have to login to check this cart out.'));
			if ($redirect) {
				$this->redirect(array('action' => 'view'));
			}
			return false;
		}
		return true;
	}

/**
 * 
 */
	public function admin_index() {
		$this->set('carts', $this->paginate());
	}

/**
 *
 */
	public function admin_delete($cartId = null) {
		$this->Cart->delete($cartId);
	}

}