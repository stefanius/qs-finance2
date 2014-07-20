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
 * bash cake schema create User --plugin StefUser
 *
 */
class ArosAcosSchema extends CakeSchema
{
    public $name = 'ArosAcos';

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {

    }

    public $aros_acos = [
        'id'      => ['type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'],
        'aro_id'  => ['type' => 'integer', 'null' => false, 'default' => null],
        'aco_id'  => ['type' => 'integer', 'null' => false, 'default' => null],
        '_create' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'],
        '_read'   => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'],
        '_update' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'],
        '_delete' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => '0'],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
            'ARO_ACO_KEY' => ['column' => ['aro_id', 'aco_id'], 'unique' => 1],
        ],
    ];
}
