<?php
App::uses('CartAppController', 'Cart.Controller');
/**
 * Orders Controller
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 */
class OrdersController extends CartAppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Search.Prg');
	
/**
 * Preset fields for the search
 *
 * @var array
 */
	public $presetVars = array(
		array('field' => 'username', 'type' => 'value'),
		array('field' => 'email', 'type' => 'value'),
		array('field' => 'total', 'type' => 'value'),
		array('field' => 'created', 'type' => 'value'),
	);

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('checkout');
	}

/**
 * Lists orders for the current logged in user
 *
 * @return void
 */
	public function index() {
		$userId = $this->Auth->user('id');
		$this->paginate = array(
			'conditions' => array(
				'Order.user_id' => $id));
		$this->set('orders', $this->paginate());
	}

/**
 * Displays a more detailed information about a single order for a user
 *
 * @return void
 */
	public function view($orderId = null) {
		$this->set('order', $this->Order->view($orderId, $this->Auth->user('id')));
	}

/**
 * Lists all orders for an admin
 *
 * @return void
 */
	public function admin_index() {
		$this->set('orders', $this->paginate());
	}

/**
 * 
 *
 * @return void
 */
	public function admin_view($orderId = null) {
		$this->set('order', $this->Order->view($orderId));
	}

}