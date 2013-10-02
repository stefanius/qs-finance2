<?php
/* Bookyear Test cases generated on: 2011-07-26 17:35:38 : 1311701738*/
App::import('Model', 'Bookyear');

class BookyearTest extends CakeTestCase
{
    public $fixtures = array('app.bookyear', 'app.calculation');

    public function startTest()
    {
        $this->Bookyear =& ClassRegistry::init('Bookyear');
    }

    public function endTest()
    {
        unset($this->Bookyear);
        ClassRegistry::flush();
    }

}
