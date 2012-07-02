<?php
App::uses('Controller', 'Controller');
App::uses('CartSessionComponent', 'Cart.Controller/Component');
App::uses('CakeSession', 'Model/Datasource');

class CartSessionTestController extends Controller {
/**
 * uses property
 *
 * @var array
 */
	public $uses = array();

/**
 * sessionId method
 *
 * @return string
 */
	public function sessionId() {
		return $this->Session->id();
	}

}

class CartSessionComponentTest extends CakeTestCase {
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
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		$_SESSION = null;
		$this->ComponentCollection = new ComponentCollection();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * testWrite
 *
 * @return void
 */

	public function testWrite() {
		$Cart = new CartSessionComponent($this->ComponentCollection);
		$Cart->addItem(array(
			'amount' => 10,
			'model' => 'Item',
			'foreign_key' => '1'));

		$Cart->addItem(array(
			'amount' => 1.21,
			'model' => 'Item',
			'foreign_key' => '2',
			'foo' => 'bar'));

		$result = $Cart->read();
		$this->assertEqual($result['CartsItem'], array(
			0 => array(
				'amount' => 10,
				'model' => 'Item',
				'foreign_key' => '1'),
			1 => array (
				'amount' => 1.21,
				'model' => 'Item',
				'foreign_key' => '2',
				'foo' => 'bar')));

		$Cart->addItem(array(
			'amount' => 2.21,
			'model' => 'Item',
			'foreign_key' => '2',
			'foo' => 'bar'));


		$result = $Cart->read();
		debug($result['CartsItem']);


		$Cart->removeItem('test', 'test');

		$result = $Cart->read();
		debug($result);

	}

}