<?php
App::uses('CartsItem', 'Cart.Model');
/**
 * CartsItem Test
 * 
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartsItemTest extends CakeTestCase {
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
 * startUp
 *
 * @return void
 */
	public function startTest() {
		$this->CartsItem = ClassRegistry::init('Cart.CartsItem');
	}

/**
 * tearDown
 *
 * @return void
 */
	public function endTest() {
		ClassRegistry::flush();
		unset($this->Cart);
	}

/**
 * testInstance
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->CartsItem, 'CartsItem'));
	}

}