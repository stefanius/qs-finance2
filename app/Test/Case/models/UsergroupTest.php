<?php
/* Usergroup Test cases generated on: 2011-07-19 11:30:57 : 1311075057*/
App::import('Model', 'Usergroup');

class UsergroupTest extends CakeTestCase
{
    public $fixtures = array('app.usergroup');

    public function startTest()
    {
        $this->Usergroup =& ClassRegistry::init('Usergroup');
    }

    public function endTest()
    {
        unset($this->Usergroup);
        ClassRegistry::flush();
    }

}
