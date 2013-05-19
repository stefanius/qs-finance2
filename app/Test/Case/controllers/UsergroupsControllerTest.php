<?php
/* Usergroups Test cases generated on: 2011-07-19 11:34:15 : 1311075255*/
App::import('Controller', 'Usergroups');

class TestUsergroupsController extends UsergroupsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UsergroupsControllerTest extends CakeTestCase {
	var $fixtures = array('app.usergroup');

	function startTest() {
		$this->Usergroups =& new TestUsergroupsController();
		$this->Usergroups->constructClasses();
	}

	function endTest() {
		unset($this->Usergroups);
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