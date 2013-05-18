<?php
/* Bookyear Fixture generated on: 2011-07-26 17:35:35 : 1311701735 */
class BookyearFixture extends CakeTestFixture {
	var $name = 'Bookyear';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'startdatum' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'einddatum' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4e2efae7-2e50-4aa6-9427-083c9d87f14d',
			'startdatum' => '2011-07-26',
			'einddatum' => '2011-07-26',
			'omschrijving' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-07-26 17:35:35',
			'modified' => '2011-07-26 17:35:35'
		),
	);
}
?>