<?php
class CartRuleTest extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures  = array(
		'plugin.cart.cart_rule',
		'plugin.cart.cart_rule_conditions');

/**
 * startUp
 *
 * @return void
 */
	public function startUp() {
		$this->CartRule = ClassRegistry::init('Cart.CartRule');
	}

/**
 * testApplyRules
 *
 * @return void
 */
	public function testApplyRules() {
		$cartData = array(
			'User' => array(),
			'Cart' => array(),
			'CartsItem' => array(
				array(
					'name' => 'Digital Download Item',
					'quantity' => '1',
					'price' => '0.99'),
				array(
					'name' => 'Geek Cup of Coffee',
					'quantity' => '3',
					'price' => '13.37')));


		$this->CartRule->applyRules($cartData);
	}

}