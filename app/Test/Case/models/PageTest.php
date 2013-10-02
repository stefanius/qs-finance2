<?php
/* Page Test cases generated on: 2011-07-19 11:29:47 : 1311074987*/
App::import('Model', 'Page');

class PageTest extends CakeTestCase
{
    public $fixtures = array('app.page', 'app.user');

    public function startTest()
    {
        $this->Page =& ClassRegistry::init('Page');
    }

    public function endTest()
    {
        unset($this->Page);
        ClassRegistry::flush();
    }

}
