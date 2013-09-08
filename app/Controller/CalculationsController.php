<?php
class CalculationsController extends AppController {
	var $name = 'Calculations';
	var $helpers = array('Form', 'Html', 'Number',  'Balans');
	//var $components = array('Excel');

	function beforeFilter() {
		parent::resetSessionArgs();
	}

	function index() {
		$this->Calculation->recursive = 0;
		$this->set('calculations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid calculation'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Calculation->recursive = 1;
		$this->set('calculation', $this->Calculation->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Calculation->create();
			if ($this->Calculation->save($this->request->data)) {
				$this->Session->setFlash(__('The calculation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.'));
			}
		}
		$grootboeks = $this->Calculation->Grootboek->find('list');
		$bookyears = $this->Calculation->Bookyear->find('list');
		$this->set(compact('grootboeks', 'bookyears'));
	}
	
	function crossbooking($bookyear=null, $grootboek=null, $debetcredit=null) {
		$boekingstuk_model = ClassRegistry::init('Boekingstukken');
		if (!empty($this->request->data)) {
			$incommingData = $this->request->data;	
			if($incommingData['Calculation']['DebetCredit']=='c'){
				$incommingData['Calculation'][1]['debet'] = $incommingData['Calculation'][0]['credit'];
				$incommingData['Calculation'][1]['omschrijving'] = $incommingData['Calculation'][0]['omschrijving'];
				$incommingData['Calculation'][0]['omschrijving'] = $incommingData['Calculation'][0]['omschrijving'];
			}elseif($incommingData['Calculation']['DebetCredit']=='d'){
				$incommingData['Calculation'][1]['credit'] = $incommingData['Calculation'][0]['debet'];
				$incommingData['Calculation'][1]['omschrijving'] = $incommingData['Calculation'][0]['omschrijving'];
				$incommingData['Calculation'][0]['omschrijving'] = $incommingData['Calculation'][0]['omschrijving'];			
			}
			
			if(strlen($incommingData['Calculation'][0]['boekingstuk']) < 1 ){
				$incommingData['Calculation'][0]['boekingstuk'] = "@@@".time(); //@@@ wordt gebruikt als 'tag' voor een gegenereerd boekingsstuk.
			}else{
				$incommingData['Calculation'][0]['boekingstuk'] = $boekingstuk_model->retrieve($incommingData['Calculation'][0]['bookyear_id'], $incommingData['Calculation'][0]['boekingstuk']);
			}
			
			$incommingData['Calculation'][1]['bookyear_id'] = $incommingData['Calculation'][0]['bookyear_id'];
			$incommingData['Calculation'][1]['boekingstuk'] = $incommingData['Calculation'][0]['boekingstuk'];
			$incommingData['Calculation'][1]['boekdatum'] = $incommingData['Calculation'][0]['boekdatum'];
			
			unset($incommingData['Calculation']['DebetCredit']);	
			if ($this->Calculation->saveAll($incommingData['Calculation'])) {
				$this->Session->setFlash(__('Mutatie is verwerkt'));
				$this->redirect(array('controller' => 'grootboeks', 'action' => 'open', $incommingData['Calculation'][0]['bookyear_id'], $incommingData['Calculation'][0]['grootboek_id']));
			} else {
				$this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld'));
			}		
		}
		
		if(isset($bookyear) && isset($grootboek)&& isset($debetcredit)){
			$grootboeks = $this->Calculation->Grootboek->find('list');
			$currentgrootboek = $this->Calculation->Grootboek->get($grootboek);
			$bookyear = $this->Calculation->Bookyear->get($bookyear);
			$info['Grootboek'] = $currentgrootboek['Grootboek'];
			$info['Bookyear'] = $bookyear['Bookyear'];
			$boekingstukken = $boekingstuk_model->create_new_stukken($bookyear['Bookyear']['id'], $info['Bookyear']['omschrijving'] );
			unset($currentgrootboek);
			unset($bookyear);
						
			if($debetcredit == 'd'){
				$info['debetcredit']['d'] = 'text';
				$info['debetcredit']['c'] = 'hidden';
				$info['debetcredit']['dc'] = 'd';
				$info['header'] = "Debet Boeking :: ".$info['Grootboek']['nummer'];
			}elseif($debetcredit == 'c'){
				$info['debetcredit']['c'] = 'text';
				$info['debetcredit']['d'] = 'hidden';
				$info['debetcredit']['dc'] = 'c';
				$info['header'] = "Credit Boeking :: ".$info['Grootboek']['nummer'];
			}
			
			$this->set(compact('grootboeks', 'info', 'boekingstukken'));
		}else{
			$this->redirect(array('controller' => 'bookyears', 'action' => 'selectBookyear'));
		}
	}
	function newfact($bookyear=null, $grootboek=null, $debetcredit=null) {
		if (!empty($this->request->data)) {
			$this->Calculation->create();
			if ($this->Calculation->save($this->request->data)) {
				$this->Session->setFlash(__('Mutatie is verwerkt'));
				$this->redirect(array('controller' => 'balans', 'action' => 'open', $this->request->data['Calculation']['bookyear_id']));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.'));
			}
		}
		if(isset($bookyear) && isset($grootboek)&& isset($debetcredit)){
			$grootboeks = $this->Calculation->Grootboek->find('list');
			$currentgrootboek = $this->Calculation->Grootboek->get($grootboek);
			$bookyear = $this->Calculation->Bookyear->get($bookyear);
			$info['Grootboek'] = $currentgrootboek['Grootboek'];
			$info['Bookyear'] = $bookyear['Bookyear'];
			$boekingstukken = "";//$boekingstuk_model->create_new_stukken($bookyear['Bookyear']['id'], $info['Bookyear']['omschrijving'] );
			unset($currentgrootboek);
			unset($bookyear);
						
			if($debetcredit == 'd'){
				$info['debetcredit']['d'] = 'text';
				$info['debetcredit']['c'] = 'hidden';
				$info['debetcredit']['dc'] = 'd';
				$info['header'] = "Debet Boeking :: ".$info['Grootboek']['nummer'];
			}elseif($debetcredit == 'c'){
				$info['debetcredit']['c'] = 'text';
				$info['debetcredit']['d'] = 'hidden';
				$info['debetcredit']['dc'] = 'c';
				$info['header'] = "Credit Boeking :: ".$info['Grootboek']['nummer'];
			}
			
			$this->set(compact('grootboeks', 'info', 'boekingstukken'));
		}else{
			$this->redirect(array('controller' => 'bookyears', 'action' => 'selectBookyear'));
		}
	}	
	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid calculation'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Calculation->save($this->request->data)) {
				$this->Session->setFlash(__('The calculation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Calculation->read(null, $id);
		}
		$grootboeks = $this->Calculation->Grootboek->find('list');
		$bookyears = $this->Calculation->Bookyear->find('list');
		$this->set(compact('grootboeks', 'bookyears'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calculation'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Calculation->delete($id)) {
			$this->Session->setFlash(__('Calculation deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Calculation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	function ExportExcel($bookyear=null){
		if(isset($bookyear)){
			$balansposten = $this->selectsaldi($bookyear, 0);//0=balansposten
			$this->Excel->exportbalans($balansposten);
			$this->Session->setFlash(__('Excelsheet Ge�xporteerd'));
			exit;
		}else{
			$this->Session->setFlash(__('Boekjaar Onbekend'));
		}	
	}

	function ExportKolomBalans($bookyear=null){
		if(isset($bookyear)){
			$kolommen = $this->select_kolomen_balans($bookyear);
			$this->Excel->exportkolombalans($kolommen);
			$this->Session->setFlash(__('Excelsheet Ge�xporteerd'));
			exit;
		}else{
			$this->Session->setFlash(__('Boekjaar Onbekend'));
		}		

	}	
	
	function listbyboekingstuk($boekingstuk){
		$calculations = $this->Calculation->getByBoekingsstuk($boekingstuk);
		$this->set(compact('calculations','boekingstuk'));
	}
	
	function import($bookyear_key=null){

		if (!empty($this->request->data)) {
			$bookyear = $this->Calculation->Bookyear->get($this->request->data['Bookyear']['id']);
			$fileOK = $this->uploadFiles('import/'.$bookyear['Bookyear']['id'].'/kwartaal', $this->request->data['File']);
			
			if(array_key_exists('errors', $fileOK)){
				$this->Session->setFlash(__($fileOK['errors'][0]));
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}else{
				$param['Bookyear'] = $bookyear['Bookyear'];
				$param['filename'] = WWW_ROOT.$fileOK['urls'][0];
				$calcs = $this->Excel->readkwartaal($param);
				
				if ($this->Calculation->saveAll($calcs['Calculation'])) {
					$this->Session->setFlash(__('Excelsheet is verwerkt'));
					$this->redirect(array('controller' => 'balans', 'action' => 'open', $bookyear['Bookyear']['omschrijving']));
				} else {
					print_r($calcs['Calculation']);
					$this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld'));
				}
			}
			//$this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}else if(isset($bookyear_key)){
			$bookyear = $this->Calculation->Bookyear->get($bookyear_key);
			$this->set(compact('bookyear'));
		}else{
			$this->Session->setFlash(__('Geen boekjaar ingesteld, import wordt geweigerd.'));
		}
		
		
	}		
}
?>