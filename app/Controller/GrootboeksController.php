<?php
class GrootboeksController extends AppController {

	var $name = 'Grootboeks';
	var $helpers = array('Balans');
	
	function index() {
		$this->Grootboek->recursive = 0;
		$this->set('grootboeks', $this->Grootboek->getPosten());
	}

	function view($key = null) {
		if (!$key) {
			$this->Session->setFlash(__('Invalid grootboek'));
			$this->redirect(array('action' => 'index'));
		} 
		$this->set('grootboek', $this->Grootboek->get($key));
	}

	function add() {
		if (!empty($this->request->data)) {
			if($this->request->data['Grootboek']['debetcredit']=='result'){
				$this->request->data['Grootboek']['debetcredit']='credit';
				$this->request->data['Grootboek']['winstverlies']=1;
			}else{
				$this->request->data['winstverlies']=0;
			}
			
			$this->Grootboek->create();
			if ($this->Grootboek->save($this->request->data)) {
				$this->Session->setFlash(__('The grootboek has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grootboek could not be saved. Please, try again.'));
			}
		}
	}

	function edit($key = null) {
		if (!$key && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid grootboek'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Grootboek->save($this->request->data)) {
				$this->Session->setFlash(__('The grootboek has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grootboek could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Grootboek->get($key);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for grootboek'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Grootboek->delete($id)) {
			$this->Session->setFlash(__('Grootboek deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Grootboek was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function open($bookyear_key, $grootboek_key){
		$bookyear = $this->Grootboek->Bookyear->get($bookyear_key);
		$grootboek = $this->Grootboek->getSaldi($bookyear['Bookyear']['id'], $grootboek_key);	
		$this -> Session -> write("grootboek", $grootboek['Grootboek']['nummer']);
		$this -> Session -> write("bookyear", $bookyear['Bookyear']['omschrijving']);
				
		$this->set(compact('grootboek', 'bookyear'));
	}
	
	function overzicht($bookyear_key, $type){
		// 0 = balans, 1 = resultaat
		$posten =  $this->Grootboek->getPosten($type);
		$bookyear = $this->Grootboek->Bookyear->get($bookyear_key);
		$overzicht[0] = "";
		$i=0;
		foreach($posten as $post){
			$saldi = $this->Grootboek->getSaldi($bookyear['Bookyear']['id'], $post['Grootboek']['id']);
			$overzicht[$i] = $saldi;
			$i++;
		}
		$this->set(compact('overzicht', 'bookyear'));
	}
}
?>