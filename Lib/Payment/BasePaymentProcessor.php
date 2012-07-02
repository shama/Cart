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
 */
abstract class BasePaymentProcessor extends Object {
/**
 * Constructor
 *
 * @return void
 */
	public function __construct($options = array()) {
		$this->response = new CakeResponse();
	}

/**
 * Callback Url
 * 
 * @var mixed array or string url, parseable by the Router
 */
	public $callbackUrl = array('admin' => false, 'plugin' => 'cart', 'controller' => 'cart', 'action' => 'callback');

/**
 * Return Url
 *
 * @var mixed array or string url, parseable by the Router
 */
	public $returnUrl = array('admin' => false, 'plugin' => 'cart', 'controller' => 'cart', 'action' => 'thank_you');

/**
 * Cancel Url
 *
 * @var mixed array or string url, parseable by the Router
 */
	public $cancelUrl = array('admin' => false, 'plugin' => 'cart', 'controller' => 'cart', 'action' => 'cancel_checkout');

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