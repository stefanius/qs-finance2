<?php
class SchemasController extends AppController {

	var $name = 'Schemas';

	function index() {
		$this->Schema->recursive = 0;
		$this->set('schemas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid schema', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schema', $this->Schema->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Schema->create();
			if ($this->Schema->save($this->data)) {
				$this->Session->setFlash(__('The schema has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schema could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid schema', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Schema->save($this->data)) {
				$this->Session->setFlash(__('The schema has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schema could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Schema->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for schema', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Schema->delete($id)) {
			$this->Session->setFlash(__('Schema deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Schema was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function buildoverzicht(){
		$patterns = $this->Schema->getpatterns();
		for($i=0; $i < count($patterns); $i++){
			$pattern = $patterns[$i]['schemas']['nummer'];
			$list[$pattern]['pattern']['nummer'] =  $patterns[$i]['schemas']['nummer'];
			$list[$pattern]['pattern']['omschrijving'] =  $patterns[$i]['schemas']['omschrijving'];
			$list[$pattern]['items'] = $this->Schema->matchpatterns($pattern);
		}	
		return $list;
	}
}
