<?php
/* Portfolios Test cases generated on: 2011-07-21 22:53:55 : 1311288835*/
App::import('Controller', 'Portfolios');

class TestPortfoliosController extends PortfoliosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PortfoliosControllerTest extends CakeTestCase {
	var $fixtures = array('app.portfolio');

	function startTest() {
		$this->Portfolios =& new TestPortfoliosController();
		$this->Portfolios->constructClasses();
	}

	function endTest() {
		unset($this->Portfolios);
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