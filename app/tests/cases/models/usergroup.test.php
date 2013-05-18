<?php
/* Usergroup Test cases generated on: 2011-07-19 11:30:57 : 1311075057*/
App::import('Model', 'Usergroup');

class UsergroupTestCase extends CakeTestCase {
	var $fixtures = array('app.usergroup');

	function startTest() {
		$this->Usergroup =& ClassRegistry::init('Usergroup');
	}

	function endTest() {
		unset($this->Usergroup);
		ClassRegistry::flush();
	}

}
?>