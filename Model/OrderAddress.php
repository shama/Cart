<?php
App::uses('CartAppModel', 'Cart.Model');
/**
 * Order Address Model
 *
 * Thought to be used for shipping and billing addresses
 */
class OrderAddress extends CartAppModel {
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Cart.Order'));

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty')),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty')),
	);

}