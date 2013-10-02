<?php
/* Aco Test cases generated on: 2011-07-24 21:09:59 : 1311541799*/
App::import('Model', 'Aco');

class AcoTest extends CakeTestCase
{
    public $fixtures = array('app.aco', 'app.aro', 'app.aros_aco');

    public function startTest()
    {
        $this->Aco =& ClassRegistry::init('Aco');
    }

    public function endTest()
    {
        unset($this->Aco);
        ClassRegistry::flush();
    }

}
