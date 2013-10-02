<?php
/* Nav Test cases generated on: 2011-07-18 16:18:46 : 1311005926*/
App::import('Model', 'Nav');

class NavTest extends CakeTestCase
{
    public $fixtures = array('app.nav');

    public function startTest()
    {
        $this->Nav =& ClassRegistry::init('Nav');
    }

    public function endTest()
    {
        unset($this->Nav);
        ClassRegistry::flush();
    }

}
