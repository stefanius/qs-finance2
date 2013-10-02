<?php
/* Pages Test cases generated on: 2011-07-19 11:33:27 : 1311075207*/
App::import('Controller', 'Pages');

class TestPagesController extends PagesController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class PagesControllerTest extends CakeTestCase
{
    public $fixtures = array('app.page', 'app.user');

    public function startTest()
    {
        $this->Pages =& new TestPagesController();
        $this->Pages->constructClasses();
    }

    public function endTest()
    {
        unset($this->Pages);
        ClassRegistry::flush();
    }

    public function testIndex()
    {
    }

    public function testView()
    {
    }

    public function testAdd()
    {
    }

    public function testEdit()
    {
    }

    public function testDelete()
    {
    }

}
