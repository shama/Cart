<?php
/**
 * AllModelTest
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class AllModelTest extends PHPUnit_Framework_TestSuite {

/**
 * suite method, defines tests for this suite.
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Model related class tests');
		$suite->addTestDirectory(__DIR__ . DS . 'Model' . DS);
		return $suite;
	}
}

