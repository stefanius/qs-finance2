<?php
/* Bookyears Test cases generated on: 2011-07-26 17:39:41 : 1311701981*/
App::import('Controller', 'Bookyears');

class TestBookyearsController extends BookyearsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BookyearsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.bookyear', 'app.calculation', 'app.grootboek');

	function startTest() {
		$this->Bookyears =& new TestBookyearsController();
		$this->Bookyears->constructClasses();
	}

	function endTest() {
		unset($this->Bookyears);
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