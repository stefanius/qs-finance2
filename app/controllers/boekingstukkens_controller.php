<?php
class BoekingstukkensController extends AppController {

	var $name = 'Boekingstukkens';

	function index($bookyear){
		$this->Boekingstukken->recursive = 0;
		$boekingstukkens = $this->Boekingstukken->getBoekingstukken($bookyear);
		$this->set(compact('boekingstukkens'));
	}
	function pattern() {
		$this->Boekingstukken->recursive = 0;
		$this->set('boekingstukkens', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid boekingstukken', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('boekingstukken', $this->Boekingstukken->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Boekingstukken->create();
			if ($this->Boekingstukken->save($this->data)) {
				$this->Session->setFlash(__('The boekingstukken has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The boekingstukken could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid boekingstukken', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Boekingstukken->save($this->data)) {
				$this->Session->setFlash(__('The boekingstukken has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The boekingstukken could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Boekingstukken->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for boekingstukken', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Boekingstukken->delete($id)) {
			$this->Session->setFlash(__('Boekingstukken deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Boekingstukken was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function bla($bookyear_id){
		$this->Boekingstukken->create_new_stukken($bookyear_id);
	}
}
?>