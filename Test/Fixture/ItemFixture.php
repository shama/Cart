<?php
/**
 * ItemFixture
 *
 */
class ItemFixture extends CakeTestFixture {

/**
 * Name
 *
 * @var string $name
 */
	public $name = 'Item';

/**
 * Table
 *
 * @var array $table
 */
	public $table = 'items';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'price' => array('type'=>'float', 'null' => false, 'default' => NULL, 'length' => 8.2),
			'active' => array('type'=>'boolean', 'null' => false, 'default' => 0),
			'indexes' => array(
				'PRIMARY' => array('column' => 'id', 'unique' => 1))
			);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id'  => 'item-1',
			'name' => 'Cake',
			'price' => '13.37',
			'active' => 1
		),
		array(
			'id'  => 'item-2',
			'name' => 'Cake',
			'price' => '51.61',
			'active' => 1
		),
		array(
			'id'  => 'item-3',
			'name' => 'Cake',
			'price' => '55.17',
			'active' => 1
		),
	);

}
