<?php
/* Bookyears Test cases generated on: 2011-07-26 17:39:41 : 1311701981*/
App::import('Controller', 'Bookyears');

class TestBookyearsController extends BookyearsController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class BookyearsControllerTest extends CakeTestCase
{
    public $fixtures = array('app.bookyear', 'app.calculation', 'app.grootboek');

    public function startTest()
    {
        $this->Bookyears =& new TestBookyearsController();
        $this->Bookyears->constructClasses();
    }

    public function endTest()
    {
        unset($this->Bookyears);
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
