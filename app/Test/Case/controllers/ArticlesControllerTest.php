<?php
/* Articles Test cases generated on: 2011-07-19 11:31:56 : 1311075116*/
App::import('Controller', 'Articles');

class TestArticlesController extends ArticlesController
{
    public $autoRender = false;

    public function redirect($url, $status = null, $exit = true)
    {
        $this->redirectUrl = $url;
    }
}

class ArticlesControllerTest extends CakeTestCase
{
    public $fixtures = array('app.article', 'app.section', 'app.articles_section', 'app.link', 'app.links_section');

    public function startTest()
    {
        $this->Articles =& new TestArticlesController();
        $this->Articles->constructClasses();
    }

    public function endTest()
    {
        unset($this->Articles);
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
