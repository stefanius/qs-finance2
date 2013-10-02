<?php
/* Event Test cases generated on: 2011-07-19 11:21:06 : 1311074466*/
App::import('Model', 'Event');

class EventTest extends CakeTestCase
{
    public $fixtures = array('app.event');

    public function startTest()
    {
        $this->Event =& ClassRegistry::init('Event');
    }

    public function endTest()
    {
        unset($this->Event);
        ClassRegistry::flush();
    }

}
