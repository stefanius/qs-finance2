<?php
/* Aro Test cases generated on: 2011-07-24 21:10:16 : 1311541816*/
App::import('Model', 'Aro');

class AroTestCase extends CakeTestCase {
	var $fixtures = array('app.aro', 'app.aco', 'app.aros_aco');

	function startTest() {
		$this->Aro =& ClassRegistry::init('Aro');
	}

	function endTest() {
		unset($this->Aro);
		ClassRegistry::flush();
	}

}
?>