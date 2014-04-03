<?php
App::uses('Organisation', 'Model');

/**
 * Organisation Test Case
 *
 */
class OrganisationTest extends CakeTestCase
{
/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = array(
        'app.organisation'
    );

/**
 * setUp method
 *
 * @return void
 */
    public function setUp()
    {
        parent::setUp();
        $this->Organisation = ClassRegistry::init('Organisation');
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown()
    {
        unset($this->Organisation);

        parent::tearDown();
    }

}
