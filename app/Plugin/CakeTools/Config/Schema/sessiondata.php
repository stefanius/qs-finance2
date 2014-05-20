<?php
/**
 * This is Sessions Schema file
 *
 * Use it to configure database for Sessions
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config.Schema
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/*
 *
 * Using the Schema command line utility
 * bash cake schema create Sessiondata --plugin CakeTools
 *
 */
class SessiondataSchema extends CakeSchema
{
    public $name = 'Sessiondata';

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {
    }

    public $session_data = array(
        'id'             => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
        'data'           => array('type' => 'text', 'null' => true, 'default' => null),
        'useragent'      => array('type' => 'string', 'null' => false, 'default' => null),
        'user_id'        => array('type' => 'integer', 'null' => false, 'default' => null),
        'ip'             => array('type' => 'string', 'null' => false, 'default' => null),
        'os'             => array('type' => 'string', 'null' => false, 'default' => null),
        'browser'        => array('type' => 'string', 'null' => false, 'default' => null),
        'browserversion' => array('type' => 'string', 'null' => false, 'default' => null),
        'city'           => array('type' => 'string', 'null' => false, 'default' => null),
        'country'        => array('type' => 'string', 'null' => false, 'default' => null),
        'state'          => array('type' => 'string', 'null' => false, 'default' => null),
        'expires'        => array('type' => 'timestamp', 'null' => true, 'default' => null),
        'created'        => array('type' => 'timestamp', 'null' => true),
        'modified'       => array('type' => 'timestamp', 'null' => true),
        'indexes'        => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
    );

}
