<?php
/* Links Test cases generated on: 2011-07-19 11:32:40 : 1311075160*/
App::import('Controller', 'Links');

class TestLinksController extends LinksController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class LinksControllerTest extends CakeTestCase
{
    public $fixtures = array('app.link', 'app.section', 'app.article', 'app.articles_section', 'app.links_section');

    public function startTest()
    {
        $this->Links =& new TestLinksController();
        $this->Links->constructClasses();
    }

    public function endTest()
    {
        unset($this->Links);
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
