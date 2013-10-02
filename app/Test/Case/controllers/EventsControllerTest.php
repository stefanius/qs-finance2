<?php
/* Events Test cases generated on: 2011-07-19 11:32:14 : 1311075134*/
App::import('Controller', 'Events');

class TestEventsController extends EventsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class EventsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.event');

    public function startTest()
    {
        $this->Events =& new TestEventsController();
        $this->Events->constructClasses();
    }

    public function endTest()
    {
        unset($this->Events);
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
