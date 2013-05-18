<?php
/* Section Fixture generated on: 2011-07-19 11:30:07 : 1311075007 */
class SectionFixture extends CakeTestFixture {
	var $name = 'Section';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary', 'comment' => 'The unique ID of the section'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'comment' => 'The section name', 'charset' => 'latin1'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'comment' => 'The ID of the parent section'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor ',
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1
		),
	);
}
?>