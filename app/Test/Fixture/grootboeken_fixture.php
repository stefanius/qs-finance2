<?php
/* Grootboeken Fixture generated on: 2011-07-26 17:32:54 : 1311701574 */
class GrootboekenFixture extends CakeTestFixture
{
    public $name = 'Grootboeken';
    public $table = 'grootboeken';

    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'nummer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'debetcredit' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 7, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'nummer' => array('column' => 'nummer', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    public $records = array(
        array(
            'id' => '4e2efa46-8e44-40a6-986e-22789d87f14d',
            'nummer' => 'Lo',
            'omschrijving' => 'Lorem ipsum dolor sit amet',
            'debetcredit' => 'Lorem'
        ),
    );
}
