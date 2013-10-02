<?php
class GroupsController extends AppController
{
    public $name = 'Groups';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('index', 'view');
    }

    public function index()
    {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid group'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('group', $this->Group->read(null, $id));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid group'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Group->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for group'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Group->delete($id)) {
            $this->Session->setFlash(__('Group deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Group was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function buildacl()
    {
        build_acl();
    }
}
