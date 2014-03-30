<?php
class UsersController extends AppController
{
    public $name = 'Users';
    
    public $components = array('ClientDetect', 'Curl');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array( 'login');
    }

    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

        public function login()
        {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash(__('Invalid username or password, try again'));
                }
            }
        }

    public function logout()
    {
        $this->login = false;
        $this->Session->setFlash('Good-Bye');
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid user'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

        public function add()
        {
            if ($this->request->is('post')) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
        }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid user'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        //$organisations = $this->User->Organisation->find('list');
        
        $this->set(compact('groups', 'organisations'));
    }

    public function changepassword()
    {
        if($this->request->is('post') || $this->request->is('put')){
            if(!empty($this->request->data['User']['password']) && !empty($this->request->data['User']['password_retype'])){
                if($this->request->data['User']['password'] == $this->request->data['User']['password_retype']){
                    $user = $this->User->read(null, $this->Auth->user('id'));
                    $user['User']['password'] = $this->request->data['User']['password'];
 
                    if($this->User->save($user)){                    	
                        $this->Session->setFlash('Je wachtwoord is aangepast', 'success');
                        $this->redirect('/');
                    } else {
                        $this->Session->setFlash('Er is iets misgegaan, probeer het later nog eens', 'danger');
                    }
                } else {
                    $this->Session->setFlash('Je wachtwoorden komen niet overeen.', 'danger');
                }
            } else {
                $this->Session->setFlash('Er is geen wachtwoord ontvangen', 'danger');
            }
        }
    	
    }    
    
    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function buildacl()
    {
        build_acl();
    }
    
    public function userinfo()
    {
    	$userAgent = $_SERVER['HTTP_USER_AGENT'];
    	$userIP = $_SERVER['REMOTE_ADDR'];
    	
    	$systemInfo = $this->ClientDetect->detect($userAgent);

    	$apiUrl = 'http://ip-api.com/json/'.$userIP;
 
    	$locationInfo = $this->Curl->get($apiUrl);

    	$this->set(compact('systemInfo', 'userAgent', 'userIP', 'locationInfo'));
    }
}
