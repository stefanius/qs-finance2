<?php
/* Grootboeks Test cases generated on: 2011-07-26 17:40:05 : 1311702005*/
App::import('Controller', 'Grootboeks');

class TestGrootboeksController extends GrootboeksController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class GrootboeksControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.grootboek', 'app.calculation', 'app.bookyear');

	function startTest() {
		$this->Grootboeks =& new TestGrootboeksController();
		$this->Grootboeks->constructClasses();
	}

	function endTest() {
		unset($this->Grootboeks);
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