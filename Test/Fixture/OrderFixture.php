<?php
/**
 * ItemFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Name
 *
 * @var string $name
 */
	public $name = 'Order';

/**
 * Table
 *
 * @var array $table
 */
	public $table = 'orders';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'billing_address_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'billing_address' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'shipping_address_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'shipping_address' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'cart_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		)
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		
	);

}
