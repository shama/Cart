<?php
/**
 * AllModelTest
 *
 * @author Florian Krämer
 * @copyright 2012 Florian Krämer
 * @license MIT
 */
class AllTest extends PHPUnit_Framework_TestSuite {

/**
 * suite method, defines tests for this suite.
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Model related class tests');
		$suite->addTestDirectory(__DIR__ . DS . 'Controller' . DS);
		$suite->addTestDirectory(__DIR__ . DS . 'Controller' . DS . 'Component' . DS);
		$suite->addTestDirectory(__DIR__ . DS . 'Model' . DS);
		$suite->addTestDirectory(__DIR__ . DS . 'Model' . DS . 'Behavior' . DS);
		$suite->addTestDirectory(__DIR__ . DS . 'View' . DS . 'Helper' . DS);
		return $suite;
	}
}

