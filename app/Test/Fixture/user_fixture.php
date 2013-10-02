<?php
/* User Fixture generated on: 2011-09-19 13:17:49 : 1316438269 */
class UserFixture extends CakeTestFixture
{
    public $name = 'User';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
        'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => 1,
            'username' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'group_id' => 1,
            'created' => '2011-09-19 13:17:49',
            'modified' => '2011-09-19 13:17:49'
        ),
    );
}
