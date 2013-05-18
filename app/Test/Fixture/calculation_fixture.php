<?php
/* Calculation Fixture generated on: 2011-07-26 17:37:14 : 1311701834 */
class CalculationFixture extends CakeTestFixture {
	var $name = 'Calculation';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'grootboek_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'bookyear_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'boekdatum' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'debet' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => 10),
		'credit' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4e2efb4a-f804-4ba3-a408-083c9d87f14d',
			'grootboek_id' => 'Lorem ipsum dolor sit amet',
			'bookyear_id' => 'Lorem ipsum dolor sit amet',
			'omschrijving' => 'Lorem ipsum dolor sit amet',
			'boekdatum' => '2011-07-26',
			'debet' => 1,
			'credit' => 1,
			'created' => '2011-07-26 17:37:14',
			'modified' => '2011-07-26 17:37:14'
		),
	);
}
?>