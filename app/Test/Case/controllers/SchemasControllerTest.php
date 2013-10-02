<?php
/* Schemas Test cases generated on: 2011-09-22 10:33:43 : 1316687623*/
App::import('Controller', 'Schemas');

class TestSchemasController extends SchemasController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class SchemasControllerTest extends CakeTestCase
{
    public $fixtures = array('app.schema');

    public function startTest()
    {
        $this->Schemas =& new TestSchemasController();
        $this->Schemas->constructClasses();
    }

    public function endTest()
    {
        unset($this->Schemas);
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
