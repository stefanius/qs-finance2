<?php

class AppController extends Controller
{
    //var $components = array('Acl', 'Auth', 'Session');
    //var $helpers = array('Html', 'Form', 'Session');

    public $components = array(

        'Session',
        'Auth' => array(
            'loginRedirect' => array('plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'),
            'authError' => 'Om acties in het systeem uit te voeren moet u zijn ingelogd!',
        )
    );

    public function beforeFilter()
    {
        $this->Auth->autoRedirect = false;
        //$this->Auth->allowedActions = array('display');
        $this->Auth->actionPath = 'controllers/';
    }

    public function checkSessionHasBookyear()
    {
        if ($this->Session->check('Bookyear')) {
            return $this->Session->read('Bookyear');
        } else {
            $this->Session->setFlash(__('Er is geen bookjaar geselecteerd.'));
            $this->redirect('/');
        }
    }
}
