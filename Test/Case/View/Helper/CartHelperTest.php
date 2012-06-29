<?php
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('FormHelper', 'View/Helper');
APp::uses('CartHelper', 'Cart.View/Helper');
App::uses('Router', 'Routing');

class CartHelperTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();

		Configure::write('App.base', '');
		$this->Controller = new Controller();
		$this->View = new View($this->Controller);
		$this->Cart = new CartHelper($this->View);
		$this->Cart->Html = new HtmlHelper($this->View);
		$this->Cart->Form = new FormHelper($this->View);
		$this->Cart->request = new CakeRequest('/', false);
	}

	public function tearDown() {
		
	}

	public function testInput() {
		$this->Cart->input('1', 'Item');
	}
}