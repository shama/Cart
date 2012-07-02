<?php
App::uses('BuyableBehavior', 'Cart.Model/Behavior');
App::uses('Model', 'Model');
/**
 * CartTestItemModel
 */
class CartTestItemModel extends Model {
/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Cart.Buyable');
}
/**
 * CartsItem Test
 * 
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class BuyableBehaviorTest extends CakeTestCase {
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
		$this->Model = ClassRegistry::init('CartTestItemModel');
		$this->Model->alias = 'Item';
	}

/**
 * tearDown
 *
 * @return void
 */
	public function endTest() {
		ClassRegistry::flush();
		unset($this->Model);
	}

/**
 * 
 */
	public function testBindCartModel() {
		$this->bindCartModel()
	}

}