<?php
/* Navs Test cases generated on: 2011-07-18 16:19:28 : 1311005968*/
App::import('Controller', 'Navs');

class TestNavsController extends NavsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class NavsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.nav');

    public function startTest()
    {
        $this->Navs =& new TestNavsController();
        $this->Navs->constructClasses();
    }

    public function endTest()
    {
        unset($this->Navs);
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
