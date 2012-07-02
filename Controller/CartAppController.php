<?php
App::uses('AppController', 'Controller');
/**
 * Cart App Controller
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class CartAppController extends AppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Session',
		'Auth');
}