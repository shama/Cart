<?php
App::uses('Controller', 'Controller');
App::uses('CartManagerComponent', 'Cart.Controller/Component');
App::uses('AuthComponent', 'Controller/Component');
/**
 * CartTestItemsController
 *
 */
class CartTestItemsController extends Controller {
	public $uses = array('Item');
	public $modelClass = 'Item';
}
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
 * startTest
 *
 * @return void
 */
	public function startTest() {
		$request = new CakeRequest(null, false);
		$this->Controller = new CartTestItemsController($request, $this->getMock('CakeResponse'));

		$this->collection = new ComponentCollection();
		$this->collection->init($this->Controller);

		$AuthMock = $this->getMock('AuthComponent', array(), array($this->collection));
		$this->Controller->Auth = $AuthMock;

		$this->CartManager = new CartManagerComponent($this->collection);
		$this->CartManager->Auth = $AuthMock;
	}

/**
 * endTest
 *
 * @return void
 */
	public function endTest() {
		ClassRegistry::flush();
		unset($this->CartManager);
	}

/**
 * testInitialize
 *
 * @return void
 */
	public function testInitialize() {
		$this->CartManager->initialize($this->Controller, array());

		$this->assertTrue(is_a($this->CartManager->CartModel, 'Cart'));
		$this->assertEqual($this->CartManager->sessionKey, 'Cart');
	}

/**
 * testStartup
 *
 * @return void
 */
	public function testStartup() {
		$this->collection = new ComponentCollection();
		$this->collection->init($this->Controller);

		$this->CartManager = $this->getMock('CartManagerComponent', array('captureBuy'), array($this->collection));
		$this->CartManager->initialize($this->Controller, array());
/*
		$this->CartManager->expectAt(0, 'captureBuy', array());
		$this->CartManager->setReturnValueAt(0, 'captureBuy', true);

		$this->Controller->action = 'buy';
		$this->CartManager->startup($this->Controller);
*/
	}

/**
 * testAddItem
 *
 * @return void
 */
	public function testAddItem() {
		//$this->CartManager->addItem();
	}

/**
 * testPostBuy
 *
 * @return void
 */
	public function testPostBuy() {
		$this->CartManager->initialize($this->Controller, array());
		$this->assertFalse($this->CartManager->postBuy());

		$this->Controller->response->expects($this->any())
			->method('is')
			->with('post')
			->will($this->returnValue(true));

		debug($this->CartManager->postBuy());
	}

/**
 * testGetBuy
 *
 * @return void
 */
	public function testGetBuy() {
		$this->CartManager->initialize($this->Controller, array());
		$this->assertFalse($this->CartManager->getBuy());
	}

}