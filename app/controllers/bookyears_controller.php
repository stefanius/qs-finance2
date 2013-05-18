<?php
class BookyearsController extends AppController {

	var $name = 'Bookyears';
	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allowedActions = array('selectBookyear', 'getBookyear');
	}

	function index() {
		$this->Bookyear->recursive = 1;
		$bookyears =  $this->paginate();
		
		for($i=0;$i< count($bookyears);$i++){
			if(count($bookyears[$i]['Calculation'])>0){
				$bookyears[$i]['allowDelete'] = 0;
			}else{
				$bookyears[$i]['allowDelete'] = 1;
			}
		}	
		$this->set(compact('bookyears'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bookyear', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Bookyear->recursive = 1;
		$this->set('bookyear', $this->Bookyear->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bookyear->create();
			if ($this->Bookyear->save($this->data)) {
				$this->Session->setFlash(__('The bookyear has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bookyear could not be saved. Please, try again.', true));
			}
		}
	}
	
	function newbookyear() {
		if (!empty($this->data)) {
			$newbookyear['prevyear'] = $this->data['Bookyear']['prevyear'];
			$this->Bookyear->create();
			if ($this->Bookyear->save($this->data)) {
				$this->Session->setFlash(__('Bookjaar aangemaakt', true));
				$newbookyear['id'] = $this->Bookyear->getLastInsertId();
				$this->redirect(array('controller' => 'balans', 'action' => 'newbalans', $newbookyear['prevyear'], $newbookyear['id']));
			} else {
				$this->Session->setFlash(__('Aanmaken bookjaar is mislukt.', true));
			}
		}
		$bookyears = $this->Bookyear->find('list', array('conditions' => array('Bookyear.closed' => 0)));
		$this->set(compact('bookyears'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid bookyear', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bookyear->save($this->data)) {
				$this->Session->setFlash(__('The bookyear has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bookyear could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bookyear->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for bookyear', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Bookyear->delete($id)) {
			$this->Session->setFlash(__('Bookyear deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bookyear was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function selectBookyear(){
		$bookyears = $this->Bookyear->find('list');
		$this->set(compact('bookyears'));	
		
	}	
	function getBookyear($closed=0){
		$bookyears = $this->Bookyear->find('all', array('conditions' => array('closed' => $closed)));
		return $bookyears;	
	}
}
?>