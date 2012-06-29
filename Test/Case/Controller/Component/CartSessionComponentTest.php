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
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
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

	public function testWrite() {
		$Cart = new CartSessionComponent($this->ComponentCollection);
		$Cart->addItem(array(
			'amount' => 10,
			'model' => 'test',
			'foreign_key' => 'test'));

		$result = $Cart->read();
		debug($result);

		$Cart->addItem(array(
			'amount' => 1.21,
			'model' => 'test',
			'foreign_key' => 'test',
			'foo' => 'bar'));

		$result = $Cart->read();
		debug($result);

		$Cart->addItem(array(
				'amount' => 2.21,
				'model' => 'test',
				'foreign_key' => 'test',
				'foo' => 'bar'));
		return;
		$result = $Cart->read();
		debug($result);


		$Cart->removeItem('test', 'test');

		$result = $Cart->read();
		debug($result);

		debug($Cart->calculateTotal());
	}

}