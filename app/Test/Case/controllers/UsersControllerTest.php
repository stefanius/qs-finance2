<?php
/* Users Test cases generated on: 2011-09-19 13:18:48 : 1316438328*/
App::import('Controller', 'Users');

class TestUsersController extends UsersController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class UsersControllerTest extends CakeTestCase
{
    public $fixtures = array('app.user', 'app.group');

    public function startTest()
    {
        $this->Users =& new TestUsersController();
        $this->Users->constructClasses();
    }

    public function endTest()
    {
        unset($this->Users);
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
