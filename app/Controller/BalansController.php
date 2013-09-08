<?php
class BalansController extends AppController {

	var $name = 'Balans';
	var $uses = 'Balans';
	//var $components = array('Excel');
	var $helpers = array('Form', 'Html', 'Number',  'Balans');
	
	function beforeFilter() {
		parent::resetSessionArgs();
		parent::beforeFilter();
		$this->Auth->allow(array('*'));
	}
	
	function index(){
		//Lijst van boekjaren/perioden.
		$this->Balans->Bookyear->recursive = 0;
		$bookyears =  $this->Balans->Bookyear->find('all');
		$this->set(compact('bookyears'));
	}

	function open($bookyear, $beginbalans=null){
		$balans = $this->Balans->openBalans($bookyear, $beginbalans);
		$balans = $this->Balans->formatBalans($balans);
		$this->set(compact('balans'));
	}
	
	function kolombalans($bookyear){
		$kolombalans = $this->Balans->openKolomBalans($bookyear);
		$this->set(compact('kolombalans'));
	}
	
	function newbalans($oldbookyear, $newbookyear){
		$this->Balans->newbalans($oldbookyear, $newbookyear);
		$bookyear = $this->Balans->Bookyear->get($newbookyear);
		$this->redirect(array('controller' => 'balans', 'action' => 'open', $bookyear['Bookyear']['omschrijving']));	
	}
}
?>