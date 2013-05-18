<?php
/* Grootboek Test cases generated on: 2011-07-26 17:37:38 : 1311701858*/
App::import('Model', 'Grootboek');

class GrootboekTestCase extends CakeTestCase {
	var $fixtures = array('app.grootboek', 'app.calculation', 'app.bookyear');

	function startTest() {
		$this->Grootboek =& ClassRegistry::init('Grootboek');
	}

	function endTest() {
		unset($this->Grootboek);
		ClassRegistry::flush();
	}

}
?>