<?php
/* Link Test cases generated on: 2011-07-19 11:29:22 : 1311074962*/
App::import('Model', 'Link');

class LinkTestCase extends CakeTestCase {
	var $fixtures = array('app.link', 'app.section', 'app.links_section');

	function startTest() {
		$this->Link =& ClassRegistry::init('Link');
	}

	function endTest() {
		unset($this->Link);
		ClassRegistry::flush();
	}

}
?>