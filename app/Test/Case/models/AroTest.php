<?php
/* Aro Test cases generated on: 2011-07-24 21:10:16 : 1311541816*/
App::import('Model', 'Aro');

class AroTest extends CakeTestCase
{
    public $fixtures = array('app.aro', 'app.aco', 'app.aros_aco');

    public function startTest()
    {
        $this->Aro =& ClassRegistry::init('Aro');
    }

    public function endTest()
    {
        unset($this->Aro);
        ClassRegistry::flush();
    }

}
