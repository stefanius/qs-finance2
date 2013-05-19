<?php
/* User Test cases generated on: 2011-09-19 13:17:51 : 1316438271*/
App::import('Model', 'User');

class UserTest extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
