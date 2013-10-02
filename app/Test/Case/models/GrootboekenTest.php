<?php
/* Grootboeken Test cases generated on: 2011-07-26 17:32:54 : 1311701574*/
App::import('Model', 'Grootboeken');

class GrootboekenTest extends CakeTestCase
{
    public $fixtures = array('app.grootboeken');

    public function startTest()
    {
        $this->Grootboeken =& ClassRegistry::init('Grootboeken');
    }

    public function endTest()
    {
        unset($this->Grootboeken);
        ClassRegistry::flush();
    }

}
