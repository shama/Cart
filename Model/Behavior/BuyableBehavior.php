<?php
App::uses('AppBehavior', 'Model');
App::uses('CakeEventManager', 'Event');
/**
 * Buyable Behavior
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class BuyableBehavior extends ModelBehavior {
/**
 * Default settings
 * - recurring: Whether or not all items are recurring subscriptions [default: false]
 * - recurringField: Name of the boolean field containing 'is_recurring',
 * - priceField: Name of the field containing item's price [default: price]
 * - nameField: Name of the field containing item's name [default: $this->displayField]
 * - billingFrequencyField: Name of the field containing the billing frequency (if recurring) [default: billing_frequency]
 * - billingPeriodField: Name of the field containing the billing period (if recurring) [default: billing_period]
 * - maxQuantity: The maximum quantity of a single item an user can buy. Either an integer, or a field name (for a custom valueper row) [default: PHP_INT_MAX]
 *
 * @var array
 * @access protected
 */
	protected $_defaults = array(
		'allVirtual' => false,
		'virtualField' => 'virtual',
		'priceField' => 'price',
		'nameField' => '', // Initialized in setup()
		'currencyField' => 'currency',
		'recurring' => false,
		'recurringField' => 'is_recurring',
		'billingFrequencyField' => 'billing_frequency',
		'billingPeriodField' => 'billing_period',
		'defaultCurrency' => 'USD',
		'maxQuantity' => PHP_INT_MAX);

/**
 * Setup
 *
 * @param AppModel $model
 * @param array $settings
 */
	public function setup(Model $Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = $this->_defaults;
		}

		if (empty($this->settings[$Model->alias]['nameField'])) {
			$this->settings[$Model->alias]['nameField'] = $Model->displayField;
		}

		$this->bindCartModel($Model);
	}

/**
 * Default method for additionalItemData model callback
 * No additional data are returned
 *
 * @return mixed Data to be serialized as additional data for the current item, null otherwise
 * @access public
 */
	public function additionalBuyData(Model $Model) {
		return array();
	}

/**
 * Binds the cart association if no HABTM assoc named 'Cart' already exists.
 *
 * @return void
 */
	public function bindCartModel(Model $Model) {
		extract($this->settings[$Model->alias]);
		if (!isset($Model->hasAndBelongsToMany['Cart'])) {
			$Model->bindModel(array(
				'hasAndBelongsToMany' => array(
					'Cart' => array(
						'className' => 'Cart.Cart',
						'foreignKey' => 'foreign_key',
						'associationForeignKey' => 'cart_id',
						'joinTable' => 'carts_items',
						'with' => 'Cart.CartsItem'))), false);
		}
	}

/**
 * Checks if a model
 *
 * @param 
 * @param 
 */
	public function isBuyable(Model $Model, $data) {
		$Model->id = $data['CartsItem']['foreign_key'];
		return $Model->exists();
	}

/**
 * Model $Model, $data
 *
 * @param 
 * @param 
 */
	public function beforeAddToCart(Model $Model, $cartsItem) {
		$record = $Model->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$Model->alias . '.' . $Model->primaryKey => $cartsItem['CartsItem']['foreign_key'])));

		return $this->composeItemData($Model, $record, $cartsItem);
	}

/**
 * Creates a cart compatible item data array from the data coming from beforeAddToCart
 *
 * @param 
 * @param 
 */
	public function composeItemData(Model $Model, $record, $cartsItem) {
		extract($this->settings[$Model->alias]);

		$result = array(
			'quantity_limit' => false,
			'is_virtual' => $allVirtual,
			'model' => get_class($Model),
			'foreign_key' => $record[$Model->alias][$Model->primaryKey],
			'name' => $record[$Model->alias][$nameField],
			'price' => $record[$Model->alias][$priceField],
			'additional_data' => serialize($Model->additionalBuyData()));

		return Set::merge($cartsItem['CartsItem'], $result);
	}

}