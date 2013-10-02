<?php
/* Article Fixture generated on: 2011-07-19 11:16:53 : 1311074213 */
class ArticleFixture extends CakeTestFixture
{
    public $name = 'Article';

    public $fields = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => 'aazz', 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'comment' => 'The unique ID of the article', 'charset' => 'latin1'),
        'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'comment' => 'The article title', 'charset' => 'latin1'),
        'tagline' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => 'Short summary of the article', 'charset' => 'latin1'),
        'thearticle' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'comment' => 'The article itself', 'charset' => 'latin1'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'clicks' => array('type' => 'integer', 'null' => false, 'default' => '0'),
        'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
    );

    public $records = array(
        array(
            'id' => '4e2567a5-d9c4-44af-b555-10649d87f14d',
            'title' => 'Lorem ipsum dolor sit amet',
            'tagline' => 'Lorem ipsum dolor sit amet',
            'thearticle' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created' => '2011-07-19 11:16:53',
            'modified' => '2011-07-19 11:16:53',
            'clicks' => 1
        ),
    );
}
