<?php
/* Schema Test cases generated on: 2011-09-22 10:33:25 : 1316687605*/
App::import('Model', 'Schema');

class SchemaTestCase extends CakeTestCase {
	var $fixtures = array('app.schema');

	function startTest() {
		$this->Schema =& ClassRegistry::init('Schema');
	}

	function endTest() {
		unset($this->Schema);
		ClassRegistry::flush();
	}

}
