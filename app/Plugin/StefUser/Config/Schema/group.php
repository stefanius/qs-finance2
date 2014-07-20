<?php
/**
 * This is Users Schema file
 *
 * Use it to configure database for Users
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
 * bash cake schema create Group --plugin StefUser
 *
 */
class GroupSchema extends CakeSchema
{
    public $name = 'Group';

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {

    }

    public $group = [
        'id'       => ['type' => 'integer', 'null' => false, 'key' => 'primary'],
        'name'     => ['type' => 'text', 'null' => true, 'default' => null],
        'created'  => ['type' => 'string', 'null' => false, 'default' => null],
        'modified' => ['type' => 'string', 'null' => false, 'default' => null],
        'indexes'  => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
    ];
}