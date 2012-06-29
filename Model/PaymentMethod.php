<?php
/**
 * Payment Method Model
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 */
class PaymentMethod extends CartsAppController {

/**
 * 
 */
	public $useTable = false;

/**
 * 
 */
	public function getPaymentMethods() {
		$configured = Configure::read('Cart.paymentProcessors');
		$data = array();
		if (!empty($configured)) {
			foreach ($configured as $processor => $options) {
				$data[$processor] = $options['name'];
			}
		}
		return $data;
	}

}