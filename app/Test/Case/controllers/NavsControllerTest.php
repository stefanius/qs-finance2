<?php
/* Navs Test cases generated on: 2011-07-18 16:19:28 : 1311005968*/
App::import('Controller', 'Navs');

class TestNavsController extends NavsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class NavsControllerTest extends CakeTestCase {
	var $fixtures = array('app.nav');

	function startTest() {
		$this->Navs =& new TestNavsController();
		$this->Navs->constructClasses();
	}

	function endTest() {
		unset($this->Navs);
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
