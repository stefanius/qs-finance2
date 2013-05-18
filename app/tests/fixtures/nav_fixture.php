<?php
/* Nav Fixture generated on: 2011-07-18 16:18:46 : 1311005926 */
class NavFixture extends CakeTestFixture {
	var $name = 'Nav';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'cp1250_bin', 'charset' => 'cp1250', 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'cp1250_bin', 'charset' => 'cp1250'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'cp1250_bin', 'charset' => 'cp1250'),
		'tag' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'cp1250_bin', 'charset' => 'cp1250'),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'cp1250', 'collate' => 'cp1250_bin', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4e245ce6-1184-4786-b158-088c9d87f14d',
			'url' => 'Lorem ipsum dolor sit amet',
			'title' => 'Lorem ipsum dolor sit amet',
			'tag' => 'Lorem ipsum dolor sit amet'
		),
	);
}
