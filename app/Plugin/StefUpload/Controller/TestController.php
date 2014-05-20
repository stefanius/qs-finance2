<?php
App::uses('StefUpload.StefUploadAppController', 'Controller');

class TestController extends StefUploadAppController {

    public $name = 'Test';
    public $uses = false;
	public $components = ['StefUpload.FS', 'StefUpload.UploadAndAnonimizeFilename', 'StefUpload.FilterUploadFields'];

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('upload');
    }

    public function upload() {

        if(isset($this->request->data['Test'])){
            $data = $this->request->data['Test'];
            $filtereddata = $this->FilterUploadFields->filter($data);

            foreach ($filtereddata as $fdata) {
                $this->UploadAndAnonimizeFilename->execute($fdata);
            }
        }

	}
}
