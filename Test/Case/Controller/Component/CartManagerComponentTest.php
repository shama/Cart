<?php
App::uses('Controller', 'Controller');
App::uses('CartManagerComponent', 'Cart.Controller/Component');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Cart Manager Component Test
 * 
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartManagerComponentTest extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.Cart.Cart',
		'plugin.Cart.Item',
		'plugin.Cart.Order',
		'plugin.Cart.CartsItem',
	);

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		$request = new CakeRequest(null, false);
		$this->Controller = new Controller($request, $this->getMock('CakeResponse'));

		$collection = new ComponentCollection();
		$collection->init($this->Controller);

		$this->CartManger = new CartManagerComponent($collection);
		//$this->CartManager->Auth = $this->getMock('AuthComponent', array($collection));
	}

/**
 * 
 *
 * @return void
 */
	public function tearDown() {
		ClassRegistry::flush();
		unset($this->CartManager);
	}

/**
 * testInitialize
 *
 * @return void
 */
	public function testInitialize() {
		$this->CartManger->initialize($this->Controller);
	}

/**
 * testStartup
 *
 * @return void
 */
	public function testStartup() {
		$this->CartManger->startup($this->Controller);
	}

/**
 * testPostBuy
 *
 * @return void
 */
	public function testPostBuy() {
		$this->CartManger->postBuy();
	}

/**
 * testGetBuy
 *
 * @return void
 */
	public function testGetBuy() {
		$this->CartManger->getBuy();
	}

}