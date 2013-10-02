<?php
/* Usergroup Fixture generated on: 2011-07-19 11:30:57 : 1311075057 */
class UsergroupFixture extends CakeTestFixture
{
    public $name = 'Usergroup';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
        'omschrijving' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'userlevel' => array('type' => 'integer', 'null' => false, 'default' => NULL),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => 1,
            'omschrijving' => 'Lorem ipsum dolor ',
            'userlevel' => 1
        ),
    );
}
