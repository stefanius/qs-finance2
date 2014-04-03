<?php
/**
 * OrganisationFixture
 *
 */
class OrganisationFixture extends CakeTestFixture
{
/**
 * Fields
 *
 * @var array
 */
    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
    );

/**
 * Records
 *
 * @var array
 */
    public $records = array(
        array(
            'id' => '5254602b-c280-4872-b79f-0a549d87f14d',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2013-10-08 19:42:35',
            'modified' => '2013-10-08 19:42:35'
        ),
    );

}
