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
            $templatepath = $this->essetial();
            $file = $templatepath.'balans.xls';
            $this->set(compact('balans', 'data','file'));
	}
        
        function essetial(){
            return  WWW_ROOT . DS . 'files' . DS . 'xsltemplates' . DS . 'balans' . DS;
        }
}
