<?php
/* Portfolio Fixture generated on: 2011-07-21 22:53:20 : 1311288800 */
class PortfolioFixture extends CakeTestFixture
{
    public $name = 'Portfolio';

    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'projectnaam' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'omschrijving' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'screenshot' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => '4e28ade0-108c-4037-9f4e-0cbc9d87f14d',
            'projectnaam' => 'Lorem ipsum dolor sit amet',
            'omschrijving' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'screenshot' => 'Lorem ipsum dolor sit amet',
            'url' => 'Lorem ipsum dolor sit amet',
            'created' => '2011-07-21 22:53:20',
            'modified' => '2011-07-21 22:53:20'
        ),
    );
}
