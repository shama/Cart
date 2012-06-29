<?php
App::uses('CartAppController', 'Cart.Controller');
/**
 * Cart App Controller
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartAppController extends CartAppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Session',
		'Auth');
}