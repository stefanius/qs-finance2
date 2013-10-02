<?php
/* Groups Test cases generated on: 2011-09-19 13:18:32 : 1316438312*/
App::import('Controller', 'Groups');

class TestGroupsController extends GroupsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class GroupsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.group', 'app.user');

    public function startTest()
    {
        $this->Groups =& new TestGroupsController();
        $this->Groups->constructClasses();
    }

    public function endTest()
    {
        unset($this->Groups);
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
