<?php
App::uses('Cart', 'Cart.Model');
/**
 * CartTest
 * 
 * 
 */
class CartTest extends CakeTest {
/**
 * 
 */
	public startUp() {
		$this->Cart = ClassRegistry::init('Cart.Cart');
	}

/**
 * 
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
		$this->assertTrue(is_a('Cart', $this->Cart);
	}

	public function testSyncWithSessionData() {
		$result = $this->Cart->syncWithSessionData($cartId, $data);
	}

}