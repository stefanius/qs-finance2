<?php
/* Grootboeks Test cases generated on: 2011-07-26 17:40:05 : 1311702005*/
App::import('Controller', 'Grootboeks');

class TestGrootboeksController extends GrootboeksController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class GrootboeksControllerTest extends CakeTestCase
{
    public $fixtures = array('app.grootboek', 'app.calculation', 'app.bookyear');

    public function startTest()
    {
        $this->Grootboeks =& new TestGrootboeksController();
        $this->Grootboeks->constructClasses();
    }

    public function endTest()
    {
        unset($this->Grootboeks);
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
