<?php
App::uses('CartAppModel', 'Cart.Model');
/**
 * This model is used to log all payment API transactions for debugging and
 * historical purpose.
 */
class PaymentApiTransaction extends CartAppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();


	public function initialize($processorName) {
		$token = str_replace('-', '', String::uuid());
		CakeSession::write('Payment.token', $token);
		CakeSession::write('Payment.processor', $processorName);
		return $token;
	}

	public function write($inOut = 'in', $dataOut = null) {
		$data = array();
		if ($inOut == 'in') {
			$data['content'] = serialize(array('_POST' => $_POST, '_GET' => $_GET));
		}

		$processorName = CakeSession::read('Payment.processor');
		$token = CakeSession::read('Payment.token');

		if (empty($token) || empty($processorName)) {
			throw new RuntimeException(__('Missing token or payment processor name'));
		}

		$data[$this->alias]['processor'] = $processorName;
		$data[$this->alias]['token'] = $token;

		$this->create();
		return $this->save($data);
	}

}
