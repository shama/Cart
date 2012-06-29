<?php
App::uses('Object', 'Core');
App::uses('CakeResponse', 'Network');
App::uses('PaymentProcessorException', 'Cart.Error');
App::uses('PaymentApiException', 'Cart.Error');
/**
 * BasePaymentProcessor
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 * @todo make it abstract?
 */
class BasePaymentProcessor extends Object {
/**
 * Constructor
 *
 * @return void
 */
	public function __construct() {
		$this->response = new CakeResponse();
	}

/**
 * Redirect
 *
 * @param string url to redirect to
 * @param integer Http status code
 */
	public function redirect($url, $status = null) {
		if (is_array($status)) {
			extract($status, EXTR_OVERWRITE);
		}

		if (!empty($status) && is_string($status)) {
			$codes = array_flip($this->response->httpCodes());
			if (isset($codes[$status])) {
				$status = $codes[$status];
			}
		}

		$this->response->header('Location', $url);

		if (!empty($status) && ($status >= 300 && $status < 400)) {
			$this->response->statusCode($status);
		}

		$this->response->send();
		exit;
	}

/**
 * 
 */
	public function checkout() {
		return;
	}

/**
 *
 */
	public function callback() {
		return;
	}

/**
 * Log
 *
 * @param string $message
 * @param string $type
 */
	public function log($message, $type = null) {
		if (empty($type)) {
			$type = Inflector::underscore(__CLASS__);
		}
		parent::log($message, $type);
	}

}