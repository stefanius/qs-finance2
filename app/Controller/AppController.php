<?php
include 'versie.php'; //Versie.php staat in de folder 'webroot'. Hier wordt het buildnummer geset.
class AppController extends Controller
{
    //var $components = array('Acl', 'Auth', 'Session');
    //var $helpers = array('Html', 'Form', 'Session');

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'add'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        )
    );

    public function beforeFilter()
    {
        $this->Auth->autoRedirect = false;
        $this->Auth->allowedActions = array('display');
        $this->Auth->actionPath = 'controllers/';
    }

}
