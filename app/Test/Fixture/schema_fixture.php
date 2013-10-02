<?php
/* Schema Fixture generated on: 2011-09-22 10:33:25 : 1316687605 */
class SchemaFixture extends CakeTestFixture
{
    public $name = 'Schema';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
        'nummer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => 1,
            'nummer' => 'Lo',
            'omschrijving' => 'Lorem ipsum dolor sit amet'
        ),
    );
}
