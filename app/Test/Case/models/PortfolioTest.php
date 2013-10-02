<?php
/* Portfolio Test cases generated on: 2011-07-21 22:53:21 : 1311288801*/
App::import('Model', 'Portfolio');

class PortfolioTest extends CakeTestCase
{
    public $fixtures = array('app.portfolio');

    public function startTest()
    {
        $this->Portfolio =& ClassRegistry::init('Portfolio');
    }

    public function endTest()
    {
        unset($this->Portfolio);
        ClassRegistry::flush();
    }

}
