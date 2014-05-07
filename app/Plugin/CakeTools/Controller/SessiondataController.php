<?php
App::uses('CakeTools.CakeToolsAppController', 'Controller');
/**
 * SessionData Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SessiondataController extends AppController {

    public $name = 'Sessiondata';
    public $uses = ['CakeTools.Sessiondata'];

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array( 'index', 'view');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sessiondata->recursive = 0;
		$this->set('Sessiondata', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sessiondata->exists($id)) {
			throw new NotFoundException(__('Invalid sessiondata'));
		}
		$options = array('conditions' => array('Sessiondata.' . $this->Sessiondata->primaryKey => $id));
		$this->set('data', $this->Sessiondata->find('first', $options));
        $this->set('objectKey', 'Sessiondata');
        $this->render('Magic/view');
	}
}
