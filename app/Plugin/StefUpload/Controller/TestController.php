<?php
App::uses('StefUpload.StefUploadAppController', 'Controller');

class TestController extends StefUploadAppController {

    public $name = 'Test';
    public $uses = ['StefUpload.FS', 'StefUpload.Upload'];

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('upload');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function upload($id = null) {

	}
}
