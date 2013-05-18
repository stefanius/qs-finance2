<?php
/* Calculations Test cases generated on: 2011-07-26 17:39:52 : 1311701992*/
App::import('Controller', 'Calculations');

class TestCalculationsController extends CalculationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CalculationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.calculation', 'app.grootboek', 'app.bookyear');

	function startTest() {
		$this->Calculations =& new TestCalculationsController();
		$this->Calculations->constructClasses();
	}

	function endTest() {
		unset($this->Calculations);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>