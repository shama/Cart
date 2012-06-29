<?php
/**
 * ItemFixture
 *
 */
class CartFixture extends CakeTestFixture {

/**
 * Name
 *
 * @var string $name
 */
	public $name = 'Cart';

/**
 * Table
 *
 * @var array $table
 */
	public $table = 'carts';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'user_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'total' => array('type'=>'float', 'null' => true, 'default' => NULL),
		'active' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
		'item_count' => array('type'=>'integer', 'null' => false, 'default' => 0, 'length' => 6),
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
