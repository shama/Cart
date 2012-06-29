<?php
class D287dbf03fef11e1b86c0800200c9a66 extends CakeMigration {
/**
 * Dependency array. Define what minimum version required for other part of db schema
 *
 * Migration defined like 'app.31' or 'plugin.PluginName.12'
 *
 * @var array $dependendOf
 * @access public
 */
	public $dependendOf = array();

/**
 * Migration array
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'carts' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'user_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'total' => array('type'=>'float', 'null' => true, 'default' => NULL),
					'active' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
					'item_count' => array('type'=>'integer', 'null' => false, 'default' => 0, 'length' => 6),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'order_addresses' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'order_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'first_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'last_name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'company' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'street' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'street2' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'city' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'zip' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'country' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 2),
					'type' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 2, 'comment' => 'billing or shipping'),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'carts_items' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'cart_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'foreign_key' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'model' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 64),
					'quantity' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 4),
					'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'price' => array('type'=>'float', 'null' => true, 'default' => NULL),
					'virtual' => array('type'=>'boolean', 'null' => true, 'default' => '0', 'comment' => 'Virtual as a download or a service'),
					'status' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 16, 'comment' => 'internal status, up to the app'), // shipped, delivered, returned, refunded...
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'orders' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'user_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'cart_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'payment_processor' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 32),
					'status' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 16, 'comment' => 'internal status, up to the app'), // completed, refunded, partial-refund, cancelled, shipped
					'transaction_status' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 16, 'status of the transaction'),
					'transaction_fee' => array('type'=>'float', 'null' => true, 'default' => NULL, 'length' => 6,2),
					'billing_address_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36),
					'billing_address' => array('type'=>'text', 'null' => true, 'default' => NULL),
					'shipping_address_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36),
					'shipping_address' => array('type'=>'text', 'null' => true, 'default' => NULL),
					'total' => array('type'=>'float', 'null' => true, 'default' => NULL),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'cart_rules' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 255),
					'description' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'type' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 255, 'comment' => 'tax, discount'),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
							'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'cart_rule_conditions' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'cart_rule_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'position' => array('type'=>'integer', 'null' => false, 'default' => '', 'length' => 2),
					'applies_to' => array('type'=>'stromg', 'null' => true, 'default' => NULL, 'comment' => 'cart, items'),
					'conditions' => array('type'=>'text', 'null' => true, 'default' => NULL),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'shipping_methods' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'price' => array('type'=>'float', 'null' => true, 'default' => NULL, 'length' => 6,2),
					'currency' => array('type' => 'integer',  'null' => true, 'default' => NULL),
					'position' => array('type' => 'integer',  'null' => true, 'default' => NULL),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
				'payment_api_transactions' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'token' => array('type'=>'string', 'null' => false, 'default' => NULL),
					'processor' => array('type'=>'string', 'null' => false, 'default' => NULL),
					'response' => array('type'=>'text', 'null' => false, 'default' => NULL),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1))
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'carts', 'carts_items', 'orders', 'shipping_methods', 'order_addresses', 'cart_rules', 'cart_rule_conditions', 'payment_api_transactions'),
		)
	);

/**
 * before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * after migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	public function after($direction) {
		return true;
	}

}