<?php
App::uses('CartAppController', 'Cart.Controller');
/**
 * 
 * 
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 */ 
class CartRulesController extends CartAppController {
/**
 * 
 */
	public function admin_index() {
		$this->set('cartRules', $this->Paginator->paginate());
	}

/**
 * 
 */
	public function admin_add() {
		$this->CartRule->add($this->request->data);
	}

/**
 * 
 */
	public function admin_edit($cartRuleId = null) {
		
	}

}