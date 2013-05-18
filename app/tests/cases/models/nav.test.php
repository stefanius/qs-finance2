<?php
/* Nav Test cases generated on: 2011-07-18 16:18:46 : 1311005926*/
App::import('Model', 'Nav');

class NavTestCase extends CakeTestCase {
	var $fixtures = array('app.nav');

	function startTest() {
		$this->Nav =& ClassRegistry::init('Nav');
	}

	function endTest() {
		unset($this->Nav);
		ClassRegistry::flush();
	}

}
