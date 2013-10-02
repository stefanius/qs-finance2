<?php
/* Aro Fixture generated on: 2011-07-24 21:10:16 : 1311541816 */
class AroFixture extends CakeTestFixture
{
    public $name = 'Aro';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
        'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
        'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
        'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
        'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => 1,
            'parent_id' => 1,
            'model' => 'Lorem ipsum dolor sit amet',
            'foreign_key' => 1,
            'alias' => 'Lorem ipsum dolor sit amet',
            'lft' => 1,
            'rght' => 1
        ),
    );
}
