<?php
/* Link Fixture generated on: 2011-07-19 11:29:22 : 1311074962 */
class LinkFixture extends CakeTestFixture {
	var $name = 'Link';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => 'zzzz', 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'comment' => 'id van de link', 'charset' => 'latin1'),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'comment' => 'de url van de link', 'charset' => 'latin1'),
		'naam' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'comment' => 'naam van de website', 'charset' => 'latin1'),
		'omschrijving' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => 'omschrijving', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4e256a92-c9f0-4fc2-ade8-10649d87f14d',
			'url' => 'Lorem ipsum dolor sit amet',
			'naam' => 'Lorem ipsum dolor sit amet',
			'omschrijving' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>