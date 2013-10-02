<?php
/* Schema Test cases generated on: 2011-09-22 10:33:25 : 1316687605*/
App::import('Model', 'Schema');

class SchemaTest extends CakeTestCase
{
    public $fixtures = array('app.schema');

    public function startTest()
    {
        $this->Schema =& ClassRegistry::init('Schema');
    }

    public function endTest()
    {
        unset($this->Schema);
        ClassRegistry::flush();
    }

}
