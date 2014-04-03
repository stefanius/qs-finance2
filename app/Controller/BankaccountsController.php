<?php
App::uses('AppController', 'Controller');
/**
 * Bankaccounts Controller
 *
 * @property Bankaccount $Bankaccount
 */
class BankaccountsController extends AppController
{

    public $components = array('Iban');
/**
 * index method
 *
 * @return void
 */
    public function index()
    {
        $this->Bankaccount->recursive = 0;
        $this->set('bankaccounts', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null)
    {
        if (!$this->Bankaccount->exists($id)) {
            throw new NotFoundException(__('Invalid bankaccount'));
        }
        $options = array('conditions' => array('Bankaccount.' . $this->Bankaccount->primaryKey => $id));
        $this->set('bankaccount', $this->Bankaccount->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Bankaccount->create();
            $ibancheck = $this->Iban->convert($this->request->data['Bankaccount']['iban']);

            if ($ibancheck['validated']) {
                $this->request->data['Bankaccount']['maatschappij'] = $ibancheck['brand'];
                $this->request->data['Bankaccount']['rekeningnummer'] = $ibancheck['bankaccount'];
            }
            var_dump($this->request->data);
            if ($this->Bankaccount->save($this->request->data) && $ibancheck['validated']) {
                $this->Session->setFlash(__("Uw rekeningnummer is gekoppeld. U kunt nu CSV's van uw bank importeren"), 'success');
                $this->redirect(array('action' => 'index'));
            } elseif ($ibancheck['validated'] === false) {
                $this->Session->setFlash(__('Het ingevoerde IBAN nummer is onjuist. Probeer het nog eens'), 'danger');
            } else {
                $this->Session->setFlash(__('De koppeling tussen uw bank en een grootboek is niet opgeslagen'), 'danger');
            }
        }
        $grootboeks = $this->Bankaccount->Grootboek->find('list');
        $this->set(compact('grootboeks'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null)
    {
        if (!$this->Bankaccount->exists($id)) {
            throw new NotFoundException(__('Invalid bankaccount'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Bankaccount->save($this->request->data)) {
                $this->Session->setFlash(__('The bankaccount has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The bankaccount could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Bankaccount.' . $this->Bankaccount->primaryKey => $id));
            $this->request->data = $this->Bankaccount->find('first', $options);
        }
        $grootboeks = $this->Bankaccount->Grootboek->find('list');
        $this->set(compact('grootboeks'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null)
    {
        $this->Bankaccount->id = $id;
        if (!$this->Bankaccount->exists()) {
            throw new NotFoundException(__('Invalid bankaccount'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Bankaccount->delete()) {
            $this->Session->setFlash(__('Bankaccount deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Bankaccount was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
