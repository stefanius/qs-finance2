<?php
/* Link Test cases generated on: 2011-07-19 11:29:22 : 1311074962*/
App::import('Model', 'Link');

class LinkTest extends CakeTestCase
{
    public $fixtures = array('app.link', 'app.section', 'app.links_section');

    public function startTest()
    {
        $this->Link =& ClassRegistry::init('Link');
    }

    public function endTest()
    {
        unset($this->Link);
        ClassRegistry::flush();
    }

}
