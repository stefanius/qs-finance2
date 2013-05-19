<?php
/* Sections Test cases generated on: 2011-07-19 11:33:56 : 1311075236*/
App::import('Controller', 'Sections');

class TestSectionsController extends SectionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SectionsControllerTest extends CakeTestCase {
	var $fixtures = array('app.section', 'app.article', 'app.articles_section', 'app.link', 'app.links_section');

	function startTest() {
		$this->Sections =& new TestSectionsController();
		$this->Sections->constructClasses();
	}

	function endTest() {
		unset($this->Sections);
		ClassRegistry::flush();
	}

}
?>