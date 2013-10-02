<?php
/* Usergroups Test cases generated on: 2011-07-19 11:34:15 : 1311075255*/
App::import('Controller', 'Usergroups');

class TestUsergroupsController extends UsergroupsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class UsergroupsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.usergroup');

    public function startTest()
    {
        $this->Usergroups =& new TestUsergroupsController();
        $this->Usergroups->constructClasses();
    }

    public function endTest()
    {
        unset($this->Usergroups);
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
