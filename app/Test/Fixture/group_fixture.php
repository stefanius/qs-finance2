<?php
/* Group Fixture generated on: 2011-09-19 13:16:39 : 1316438199 */
class GroupFixture extends CakeTestFixture
{
    public $name = 'Group';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2011-09-19 13:16:39',
            'modified' => '2011-09-19 13:16:39'
        ),
    );
}
