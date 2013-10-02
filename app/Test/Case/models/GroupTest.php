<?php
/* Group Test cases generated on: 2011-09-19 13:16:52 : 1316438212*/
App::import('Model', 'Group');

class GroupTest extends CakeTestCase
{
    public $fixtures = array('app.group', 'app.user');

    public function startTest()
    {
        $this->Group =& ClassRegistry::init('Group');
    }

    public function endTest()
    {
        unset($this->Group);
        ClassRegistry::flush();
    }

}
