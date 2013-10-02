<?php
/* Calculations Test cases generated on: 2011-07-26 17:39:52 : 1311701992*/
App::import('Controller', 'Calculations');

class TestCalculationsController extends CalculationsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class CalculationsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.calculation', 'app.grootboek', 'app.bookyear');

    public function startTest()
    {
        $this->Calculations =& new TestCalculationsController();
        $this->Calculations->constructClasses();
    }

    public function endTest()
    {
        unset($this->Calculations);
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
