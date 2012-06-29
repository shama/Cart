<?php
App::uses('Order', 'Cart.Model');
/**
 * OrderTest
 * 
 * 
 */
class OrderTest extends CakeTest {
/**
 * startUp
 *
 * @return void
 */
	public startUp() {
		$this->Order = ClassRegistry::init('Cart.Order');
	}

/**
 * tearDown
 *
 * @return void
 */
	public tearDown() {
		ClassRegistry::flush();
		unset($this->Model);
	}

/**
 * testInstance
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a('Order', $this->Order);
	}


	public function createOrder() {
		
	}

}