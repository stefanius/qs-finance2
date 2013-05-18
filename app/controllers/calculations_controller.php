<?php
class CalculationsController extends AppController {
	var $name = 'Calculations';
	var $helpers = array('Form', 'Html', 'Number',  'Balans');
	var $components = array('Excel');

	function beforeFilter() {
		parent::resetSessionArgs();
	}

	function index() {
		$this->Calculation->recursive = 0;
		$this->set('calculations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid calculation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Calculation->recursive = 1;
		$this->set('calculation', $this->Calculation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Calculation->create();
			if ($this->Calculation->save($this->data)) {
				$this->Session->setFlash(__('The calculation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.', true));
			}
		}
		$grootboeks = $this->Calculation->Grootboek->find('list');
		$bookyears = $this->Calculation->Bookyear->find('list');
		$this->set(compact('grootboeks', 'bookyears'));
	}
	
	function crossbooking($bookyear=null, $grootboek=null, $debetcredit=null) {
		$boekingstuk_model = ClassRegistry::init('Boekingstukken');
		if (!empty($this->data)) {
			$incommingData = $this->data;	
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
				$this->Session->setFlash(__('Mutatie is verwerkt', true));
				$this->redirect(array('controller' => 'grootboeks', 'action' => 'open', $incommingData['Calculation'][0]['bookyear_id'], $incommingData['Calculation'][0]['grootboek_id']));
			} else {
				$this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld', true));
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
		if (!empty($this->data)) {
			$this->Calculation->create();
			if ($this->Calculation->save($this->data)) {
				$this->Session->setFlash(__('Mutatie is verwerkt', true));
				$this->redirect(array('controller' => 'balans', 'action' => 'open', $this->data['Calculation']['bookyear_id']));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.', true));
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
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid calculation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Calculation->save($this->data)) {
				$this->Session->setFlash(__('The calculation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calculation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calculation->read(null, $id);
		}
		$grootboeks = $this->Calculation->Grootboek->find('list');
		$bookyears = $this->Calculation->Bookyear->find('list');
		$this->set(compact('grootboeks', 'bookyears'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calculation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Calculation->delete($id)) {
			$this->Session->setFlash(__('Calculation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Calculation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function select_kolomen_balans($bookyear){
		$tmp =  $this->Calculation->Bookyear->find('first',  array('conditions' => array('Bookyear.id' => $bookyear)));
		$balansposten =  $this->Calculation->Grootboek->getposten(0);
		$resultaatposten =  $this->Calculation->Grootboek->getposten(1);

		$kolommen_balans['boekjaar']['id'] = $tmp['Bookyear']['id'];
		$kolommen_balans['boekjaar']['omschrijving'] = $tmp['Bookyear']['omschrijving'];
		$kolommen_balans['boekjaar']['startdatum'] = $tmp['Bookyear']['startdatum'];
		$kolommen_balans['boekjaar']['einddatum'] = $tmp['Bookyear']['einddatum'];
		$kolommen_balans['posten']['balans'] = 	$balansposten;	
		$kolommen_balans['posten']['resultaat'] = 	$resultaatposten;	
		$kolommen_balans['beginbalans'] = $this->pre_calculate($bookyear, $balansposten,1);
		$kolommen_balans['beginbalans'] += $this->pre_calculate($bookyear, $resultaatposten,1);
		$kolommen_balans['proefbalans'] = $this->pre_calculate($bookyear, $balansposten,'*');
		$kolommen_balans['proefbalans'] += $this->pre_calculate($bookyear, $resultaatposten,'*');

		$kolommen_balans['beginbalans']['totaal']['debet'] =0;
		$kolommen_balans['beginbalans']['totaal']['credit'] =0;
		$kolommen_balans['winstverlies']['totaal']['debet'] =0;
		$kolommen_balans['winstverlies']['totaal']['credit'] =0;
		$kolommen_balans['proefbalans']['totaal']['debet'] =0;
		$kolommen_balans['proefbalans']['totaal']['credit'] =0;
		$kolommen_balans['eindbalans']['totaal']['debet'] =0;
		$kolommen_balans['eindbalans']['totaal']['credit'] =0;	
		$kolommen_balans['saldibalans']['totaal']['debet'] =0;
		$kolommen_balans['saldibalans']['totaal']['credit'] =0;	

		$kolommen_balans['beginbalans']['ev'] =0;
		$kolommen_balans['eindbalans']['ev'] =0;
		
		foreach ($kolommen_balans['posten']['resultaat'] as $balanspost){
			$gb_nummer = $balanspost['Grootboek']['nummer'];
			if($kolommen_balans['proefbalans'][$gb_nummer]['saldo'] <0){
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = ($kolommen_balans['proefbalans'][$gb_nummer]['saldo']*-1);			
			}elseif($kolommen_balans['proefbalans'][$gb_nummer]['saldo'] > 0){
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = $kolommen_balans['proefbalans'][$gb_nummer]['saldo'];	
			}else{
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = 0;			
			}
			$kolommen_balans['eindbalans'][$gb_nummer]['debet'] = 0;
			$kolommen_balans['eindbalans'][$gb_nummer]['credit'] = 0;	
			$kolommen_balans['winstverlies'][$gb_nummer]['debet'] = $kolommen_balans['saldibalans'][$gb_nummer]['debet'];
			$kolommen_balans['winstverlies'][$gb_nummer]['credit'] = $kolommen_balans['saldibalans'][$gb_nummer]['credit'];	

			$kolommen_balans['beginbalans']['totaal']['debet'] +=$kolommen_balans['beginbalans'][$gb_nummer]['debet'];
			$kolommen_balans['beginbalans']['totaal']['credit'] +=$kolommen_balans['beginbalans'][$gb_nummer]['credit'];
			$kolommen_balans['winstverlies']['totaal']['debet'] +=$kolommen_balans['winstverlies'][$gb_nummer]['debet'];
			$kolommen_balans['winstverlies']['totaal']['credit'] +=$kolommen_balans['winstverlies'][$gb_nummer]['credit'] ;
			$kolommen_balans['proefbalans']['totaal']['debet'] +=$kolommen_balans['proefbalans'][$gb_nummer]['debet'];
			$kolommen_balans['proefbalans']['totaal']['credit'] +=$kolommen_balans['proefbalans'][$gb_nummer]['credit'];
			$kolommen_balans['eindbalans']['totaal']['debet'] +=$kolommen_balans['eindbalans'][$gb_nummer]['debet'];
			$kolommen_balans['eindbalans']['totaal']['credit'] +=$kolommen_balans['eindbalans'][$gb_nummer]['credit'];
			$kolommen_balans['saldibalans']['totaal']['debet'] +=$kolommen_balans['saldibalans'][$gb_nummer]['debet'];
			$kolommen_balans['saldibalans']['totaal']['credit'] +=$kolommen_balans['saldibalans'][$gb_nummer]['credit'];				
		}

		foreach ($kolommen_balans['posten']['balans'] as $balanspost){
			$gb_nummer = $balanspost['Grootboek']['nummer'];
			if($kolommen_balans['proefbalans'][$gb_nummer]['saldo'] <0){
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = ($kolommen_balans['proefbalans'][$gb_nummer]['saldo']*-1);			
			}elseif($kolommen_balans['proefbalans'][$gb_nummer]['saldo'] > 0){
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = $kolommen_balans['proefbalans'][$gb_nummer]['saldo'];	
			}else{
				$kolommen_balans['saldibalans'][$gb_nummer]['debet'] = 0;
				$kolommen_balans['saldibalans'][$gb_nummer]['credit'] = 0;			
			}
			$kolommen_balans['winstverlies'][$gb_nummer]['debet'] = 0;
			$kolommen_balans['winstverlies'][$gb_nummer]['credit'] = 0;	
			$kolommen_balans['eindbalans'][$gb_nummer]['debet'] = $kolommen_balans['saldibalans'][$gb_nummer]['debet'];
			$kolommen_balans['eindbalans'][$gb_nummer]['credit'] = $kolommen_balans['saldibalans'][$gb_nummer]['credit'];	
		
			$kolommen_balans['beginbalans']['totaal']['debet'] +=$kolommen_balans['beginbalans'][$gb_nummer]['debet'];
			$kolommen_balans['beginbalans']['totaal']['credit'] +=$kolommen_balans['beginbalans'][$gb_nummer]['credit'];
			$kolommen_balans['winstverlies']['totaal']['debet'] +=$kolommen_balans['winstverlies'][$gb_nummer]['debet'];
			$kolommen_balans['winstverlies']['totaal']['credit'] +=$kolommen_balans['winstverlies'][$gb_nummer]['credit'] ;
			$kolommen_balans['proefbalans']['totaal']['debet'] +=$kolommen_balans['proefbalans'][$gb_nummer]['debet'];
			$kolommen_balans['proefbalans']['totaal']['credit'] +=$kolommen_balans['proefbalans'][$gb_nummer]['credit'];
			$kolommen_balans['eindbalans']['totaal']['debet'] +=$kolommen_balans['eindbalans'][$gb_nummer]['debet'];
			$kolommen_balans['eindbalans']['totaal']['credit'] +=$kolommen_balans['eindbalans'][$gb_nummer]['credit'];		
			$kolommen_balans['saldibalans']['totaal']['debet'] +=$kolommen_balans['saldibalans'][$gb_nummer]['debet'];
			$kolommen_balans['saldibalans']['totaal']['credit'] +=$kolommen_balans['saldibalans'][$gb_nummer]['credit'];
		}
		$kolommen_balans['beginbalans']['ev'] =$kolommen_balans['beginbalans']['totaal']['debet']-$kolommen_balans['beginbalans']['totaal']['credit'];
		$kolommen_balans['eindbalans']['ev'] =$kolommen_balans['eindbalans']['totaal']['debet']-$kolommen_balans['eindbalans']['totaal']['credit'];
		$kolommen_balans['proefbalans']['ev'] =$kolommen_balans['proefbalans']['totaal']['debet']-$kolommen_balans['proefbalans']['totaal']['credit'];
		$kolommen_balans['saldibalans']['ev'] =$kolommen_balans['saldibalans']['totaal']['debet']-$kolommen_balans['saldibalans']['totaal']['credit'];
		$kolommen_balans['beginbalans']['totaal']['credit'] +=$kolommen_balans['beginbalans']['ev'];
		$kolommen_balans['eindbalans']['totaal']['credit'] += $kolommen_balans['eindbalans']['ev'];
		$kolommen_balans['proefbalans']['totaal']['credit'] +=$kolommen_balans['proefbalans']['ev'];
		$kolommen_balans['saldibalans']['totaal']['credit'] +=$kolommen_balans['saldibalans']['ev'];
		return $kolommen_balans;
	}	
	
	function kolombalans($bookyear){
		$balans = $this->select_kolomen_balans($bookyear);
		$this->set(compact('balans'));
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

		if (!empty($this->data)) {
			$bookyear = $this->Calculation->Bookyear->get($this->data['Bookyear']['id']);
			$fileOK = $this->uploadFiles('import/'.$bookyear['Bookyear']['id'].'/kwartaal', $this->data['File']);
			
			if(array_key_exists('errors', $fileOK)){
				$this->Session->setFlash(__($fileOK['errors'][0], true));
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}else{
				$param['Bookyear'] = $bookyear['Bookyear'];
				$param['filename'] = WWW_ROOT.$fileOK['urls'][0];
				$calcs = $this->Excel->readkwartaal($param);
				
				if ($this->Calculation->saveAll($calcs['Calculation'])) {
					$this->Session->setFlash(__('Excelsheet is verwerkt', true));
					$this->redirect(array('controller' => 'balans', 'action' => 'open', $bookyear['Bookyear']['omschrijving']));
				} else {
					print_r($calcs['Calculation']);
					$this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld', true));
				}
			}
			//$this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}else if(isset($bookyear_key)){
			$bookyear = $this->Calculation->Bookyear->get($bookyear_key);
			$this->set(compact('bookyear'));
		}else{
			$this->Session->setFlash(__('Geen boekjaar ingesteld, import wordt geweigerd.', true));
		}
		
		
	}		
}
?>