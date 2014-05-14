<?php
App::uses('Component', 'Controller', 'StefUpload.FS');

class UploadComponent extends Component {

    protected $permitted = false;

    protected $uploadFolder = 'upload/';

    protected $rootFolder = WWW_ROOT;

    public function setPermitted($permitted)
    {
        $this->permitted = $permitted;
    }

    public function addPermitted($permitted)
    {
        if (!is_array($this->permitted)) {
            $this->permitted = [];
        }

        $this->permitted[] = $permitted;
    }

    public function setUploadFolder($uploadFolder)
    {
        $uploadFolder = trim(trim($uploadFolder), '/');

        $this->uploadFolder = $uploadFolder . '/';
    }

    public function getFullPath($subfolder = false)
    {
        if (false === $subfolder) {
            return $this->rootFolder . $this->uploadFolder;
        } else {
            return $this->rootFolder . $this->uploadFolder . $subfolder;
        }
    }

    public function createUploadFolder($subfolder = false)
    {
        return $this->FS->createDirectory($this->getFullPath($subfolder));
    }

    public function execute()
    {

    }
}