<?php
/* Portfolio Test cases generated on: 2011-07-21 22:53:21 : 1311288801*/
App::import('Model', 'Portfolio');

class PortfolioTest extends CakeTestCase {
	var $fixtures = array('app.portfolio');

	function startTest() {
		$this->Portfolio =& ClassRegistry::init('Portfolio');
	}

	function endTest() {
		unset($this->Portfolio);
		ClassRegistry::flush();
	}

}
?>