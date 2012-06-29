<?php
App::uses('AppModel', 'Model');
/**
 * Cart App Model
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartAppModel extends AppModel {
/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Containable');

}