<?php
App::uses('CartAppModel', 'Cart.Model');
/**
 * Carts Item Model
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartsItem extends CartAppModel {
/**
 * Validation domain for translations
 *
 * @var string
 */
	public $validationDomain = 'users';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Cart' => array(
			'className' => 'Cart.Cart'));

/**
 * Validation parameters
 *
 * @var array
 */
	public $validate = array(
		'foreign_key' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true,
				'allowEmpty' => false)),
		'foreign_key' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true,
				'allowEmpty' => false)),
		'cart_id' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true,
				'allowEmpty' => false))
		'quantity' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true,
				'allowEmpty' => false))
	);

/**
 * 
 */
	public function validateItem($data) {
		$this->set($data);
		return $this->validates();
	}

	public function afterSave($created) {
		
	}

/**
 * 
 */
	public function add($data) {
		$result = $this->find('first', array(
			'conditions' => array(
				'cart_id' => $data[$this->alias]['cart_id'],
				'foreign_key' => $data[$this->alias]['foreign_key'])));

		if (empty($result)) {
			
		}

		$data = array($this->alias => array($data[$this->alias]));
		foreach ($data as $item) {
			$this->create();
			$this->save($item);
		}
	}

}