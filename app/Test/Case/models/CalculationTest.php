<?php
/* Calculation Test cases generated on: 2011-07-26 17:37:15 : 1311701835*/
App::import('Model', 'Calculation');

class CalculationTest extends CakeTestCase {
	var $fixtures = array('app.calculation', 'app.grootboek', 'app.bookyear');

	function startTest() {
		$this->Calculation =& ClassRegistry::init('Calculation');
	}

	function endTest() {
		unset($this->Calculation);
		ClassRegistry::flush();
	}

}
?>