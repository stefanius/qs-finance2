<?php
/* Section Test cases generated on: 2011-07-19 11:30:07 : 1311075007*/
App::import('Model', 'Section');

class SectionTest extends CakeTestCase {
	var $fixtures = array('app.section', 'app.article', 'app.articles_section', 'app.link', 'app.links_section');

	function startTest() {
		$this->Section =& ClassRegistry::init('Section');
	}

	function endTest() {
		unset($this->Section);
		ClassRegistry::flush();
	}

}
?>