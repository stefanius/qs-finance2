<?php
/* Grootboek Fixture generated on: 2011-07-26 17:37:38 : 1311701858 */
class GrootboekFixture extends CakeTestFixture
{
    public $name = 'Grootboek';

    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'nummer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'debetcredit' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 7, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'nummer' => array('column' => 'nummer', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => '4e2efb62-75e0-4c49-a7e3-083c9d87f14d',
            'nummer' => 'Lo',
            'omschrijving' => 'Lorem ipsum dolor sit amet',
            'debetcredit' => 'Lorem'
        ),
    );
}
