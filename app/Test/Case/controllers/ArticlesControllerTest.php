<?php
/* Articles Test cases generated on: 2011-07-19 11:31:56 : 1311075116*/
App::import('Controller', 'Articles');

class TestArticlesController extends ArticlesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ArticlesControllerTest extends CakeTestCase {
	var $fixtures = array('app.article', 'app.section', 'app.articles_section', 'app.link', 'app.links_section');

	function startTest() {
		$this->Articles =& new TestArticlesController();
		$this->Articles->constructClasses();
	}

	function endTest() {
		unset($this->Articles);
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