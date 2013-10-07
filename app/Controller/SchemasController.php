<?php
class SchemasController extends AppController
{
    public $name = 'Schemas';

    public function index()
    {
        $this->Schema->recursive = 0;
        $this->set('schemas', $this->paginate());
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid schema'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('schema', $this->Schema->read(null, $id));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
            $this->Schema->create();
            if ($this->Schema->save($this->request->data)) {
                $this->Session->setFlash(__('The schema has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The schema could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid schema'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Schema->save($this->request->data)) {
                $this->Session->setFlash(__('The schema has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The schema could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Schema->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for schema'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Schema->delete($id)) {
            $this->Session->setFlash(__('Schema deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Schema was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function rekeningoverzicht()
    {
        $patterns = $this->Schema->getpatterns();
        $list = array();
        for ($i=0; $i < count($patterns); $i++) {
            $pattern = $patterns[$i]['schemas']['nummer'];
            $list[$pattern]['pattern']['nummer'] =  $patterns[$i]['schemas']['nummer'];
            $list[$pattern]['pattern']['omschrijving'] =  $patterns[$i]['schemas']['omschrijving'];
            $list[$pattern]['items'] = $this->Schema->matchpatterns($pattern);
        }

        $this->set('list', $list);
    }
}
