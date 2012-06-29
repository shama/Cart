<?php
/**
 * CartsItemFixture
 *
 */
class CartsItemFixture extends CakeTestFixture {

/**
 * Name
 *
 * @var string $name
 */
	public $name = 'CartsItem';

/**
 * Table
 *
 * @var array $table
 */
	public $table = 'carts_items';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'cart_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'foreign_key' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'model' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'quantity' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'price' => array('type'=>'float', 'null' => true, 'default' => NULL),
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
