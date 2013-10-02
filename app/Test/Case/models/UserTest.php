<?php
/* User Test cases generated on: 2011-09-19 13:17:51 : 1316438271*/
App::import('Model', 'User');

class UserTest extends CakeTestCase
{
    public $fixtures = array('app.user', 'app.group');

    public function startTest()
    {
        $this->User =& ClassRegistry::init('User');
    }

    public function endTest()
    {
        unset($this->User);
        ClassRegistry::flush();
    }

}
