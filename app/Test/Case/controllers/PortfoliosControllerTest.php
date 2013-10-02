<?php
/* Portfolios Test cases generated on: 2011-07-21 22:53:55 : 1311288835*/
App::import('Controller', 'Portfolios');

class TestPortfoliosController extends PortfoliosController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class PortfoliosControllerTest extends CakeTestCase
{
    public $fixtures = array('app.portfolio');

    public function startTest()
    {
        $this->Portfolios =& new TestPortfoliosController();
        $this->Portfolios->constructClasses();
    }

    public function endTest()
    {
        unset($this->Portfolios);
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
