<?php
/* Schemas Test cases generated on: 2011-09-22 10:33:43 : 1316687623*/
App::import('Controller', 'Schemas');

class TestSchemasController extends SchemasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchemasControllerTest extends CakeTestCase {
	var $fixtures = array('app.schema');

	function startTest() {
		$this->Schemas =& new TestSchemasController();
		$this->Schemas->constructClasses();
	}

	function endTest() {
		unset($this->Schemas);
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
