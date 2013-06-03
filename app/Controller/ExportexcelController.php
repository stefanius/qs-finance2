<?php

class ExportexcelController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Exportexcel';

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
	var $uses = array('Balans', 'Calculation', 'Bookyear', 'Grootboek' );

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function index() { 
           
	}
        
        
	function balans($bookyear){
            $balans = $this->Balans->openBalans($bookyear);
            $balans = $this->Balans->formatBalans($balans);
            $data=$balans;
            $this->set(compact('balans', 'data'));
	}
}
