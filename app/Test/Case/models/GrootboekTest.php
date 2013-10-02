<?php
/* Grootboek Test cases generated on: 2011-07-26 17:37:38 : 1311701858*/
App::import('Model', 'Grootboek');

class GrootboekTest extends CakeTestCase
{
    public $fixtures = array('app.grootboek', 'app.calculation', 'app.bookyear');

    public function startTest()
    {
        $this->Grootboek =& ClassRegistry::init('Grootboek');
    }

    public function endTest()
    {
        unset($this->Grootboek);
        ClassRegistry::flush();
    }

}
