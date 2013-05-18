<?php
/* Bookyear Test cases generated on: 2011-07-26 17:35:38 : 1311701738*/
App::import('Model', 'Bookyear');

class BookyearTestCase extends CakeTestCase {
	var $fixtures = array('app.bookyear', 'app.calculation');

	function startTest() {
		$this->Bookyear =& ClassRegistry::init('Bookyear');
	}

	function endTest() {
		unset($this->Bookyear);
		ClassRegistry::flush();
	}

}
?>