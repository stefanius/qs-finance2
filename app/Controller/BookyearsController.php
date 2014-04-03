<?php
class BookyearsController extends AppController
{
    public $name = 'Bookyears';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('selectBookyear', 'getBookyear');
    }

    public function index()
    {
        $this->Bookyear->recursive = 1;
        $bookyears =  $this->paginate();

        for ($i=0;$i< count($bookyears);$i++) {
            if (count($bookyears[$i]['Calculation'])>0) {
                $bookyears[$i]['allowDelete'] = 0;
            } else {
                $bookyears[$i]['allowDelete'] = 1;
            }
        }
        $this->set(compact('bookyears'));
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid bookyear'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Bookyear->recursive = 1;
        $this->set('bookyear', $this->Bookyear->read(null, $id));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
            $this->Bookyear->create();
            if ($this->Bookyear->save($this->request->data)) {
                $this->Session->setFlash(__('The bookyear has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The bookyear could not be saved. Please, try again.'));
            }
        }
    }

    public function newbookyear()
    {
        $bookyears = $this->Bookyear->find('list', array('conditions' => array('Bookyear.closed' => 0)));

        if (count($bookyears) > 0) {
            if (!empty($this->request->data)) {
                $newbookyear['prevyear'] = $this->request->data['Bookyear']['prevyear'];
                $this->Bookyear->create();
                if ($this->Bookyear->save($this->request->data)) {
                    $this->Session->setFlash(__('Bookjaar aangemaakt'));
                    $newbookyear['id'] = $this->Bookyear->getLastInsertId();
                    $this->redirect(array('controller' => 'balans', 'action' => 'newbalans', $newbookyear['prevyear'], $newbookyear['id']));
                } else {
                    $this->Session->setFlash(__('Aanmaken bookjaar is mislukt.'));
                }
            }
            $this->set(compact('bookyears'));
        } else {
            if (!empty($this->request->data)) {
                $this->Bookyear->create();
                $omschrijving = $this->request->data['Bookyear']['omschrijving'];
                if ($this->Bookyear->save($this->request->data)) {
                    $this->Session->setFlash(__('Het nieuwe boekjaar is opgeslagen. Hieronder ziet u direct de balans.'));
                    $this->redirect('/balans/'.$omschrijving);
                } else {
                    $this->Session->setFlash(__('Het boekjaar kon niet worden aangemaakt. Neme contact op met de helpdesk.'));
                }
            }
            $this->render('/Bookyears/add');
        }

    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid bookyear'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Bookyear->save($this->request->data)) {
                $this->Session->setFlash(__('The bookyear has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The bookyear could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Bookyear->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for bookyear'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Bookyear->delete($id)) {
            $this->Session->setFlash(__('Bookyear deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Bookyear was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function selectBookyear()
    {
        $bookyears = $this->Bookyear->find('list');
        $this->set(compact('bookyears'));

    }
    public function getBookyear($closed=0)
    {
        $bookyears = $this->Bookyear->find('all', array('conditions' => array('closed' => $closed)));

        return $bookyears;
    }
}
