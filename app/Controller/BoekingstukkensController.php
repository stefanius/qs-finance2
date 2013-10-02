<?php
class BoekingstukkensController extends AppController
{
    public $name = 'Boekingstukkens';

    public function index($bookyear)
    {
        $this->Boekingstukken->recursive = 0;
        $boekingstukkens = $this->Boekingstukken->getBoekingstukken($bookyear);
        $this->set(compact('boekingstukkens'));
    }
    public function pattern()
    {
        $this->Boekingstukken->recursive = 0;
        $this->set('boekingstukkens', $this->paginate());
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid boekingstukken'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('boekingstukken', $this->Boekingstukken->read(null, $id));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
            $this->Boekingstukken->create();
            if ($this->Boekingstukken->save($this->request->data)) {
                $this->Session->setFlash(__('The boekingstukken has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The boekingstukken could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid boekingstukken'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Boekingstukken->save($this->request->data)) {
                $this->Session->setFlash(__('The boekingstukken has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The boekingstukken could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Boekingstukken->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for boekingstukken'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Boekingstukken->delete($id)) {
            $this->Session->setFlash(__('Boekingstukken deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Boekingstukken was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function bla($bookyear_id)
    {
        $this->Boekingstukken->create_new_stukken($bookyear_id);
    }
}
