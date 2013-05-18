<?php
/* Grootboeken Test cases generated on: 2011-07-26 17:32:54 : 1311701574*/
App::import('Model', 'Grootboeken');

class GrootboekenTestCase extends CakeTestCase {
	var $fixtures = array('app.grootboeken');

	function startTest() {
		$this->Grootboeken =& ClassRegistry::init('Grootboeken');
	}

	function endTest() {
		unset($this->Grootboeken);
		ClassRegistry::flush();
	}

}
?>