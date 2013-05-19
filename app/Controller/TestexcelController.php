<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/958/The-Pages-Controller
 */
class TestexcelController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Testexcel';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	public $helpers = array('PhpExcel');  

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function test() {
            $data = array();
            $data[0]['User']['name'] = 'aap'; 
            $data[0]['Type']['name']= 'noot';  
            $data[0]['User']['date']= 'mies'; 
            $data[0]['User']['description']= 'henk'; 
            $data[0]['User']['modified'] = 'bla'; 
            $data[1]['User']['name'] = 'een'; 
            $data[1]['Type']['name']= 'twee';  
            $data[1]['User']['date']= 'drie'; 
            $data[1]['User']['description']= 'vier'; 
            $data[1]['User']['modified'] = 'vijf'; 
            $this->set(compact('data'));
	}
}
