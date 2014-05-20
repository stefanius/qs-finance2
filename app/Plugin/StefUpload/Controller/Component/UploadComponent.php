<?php
App::uses('Component', 'Controller');

class UploadComponent extends Component {

    protected $permitted = false;

    protected $uploadFolder = 'upload/';

    protected $rootFolder = WWW_ROOT;

    protected $uploadItems = [];

    public $components = ['StefUpload.ValidateUploadField', 'StefUpload.FS'];

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->createUploadFolder();
    }

    /**
     * @param array $item
     * @return bool
     */
    public function execute(array $item)
    {
        if (!$this->validate($item)) {
            return false;
        }

        if (!$this->isPermitted($item)) {
            return false;
        }

        $item = $this->manipulate($item);

        $moved =  $this->move($item);

        if ($moved) {
            $item['full_result_filename'] = $this->getFullPath() . $item['name'];
            $this->uploadItems[] = $item;
        }

        return $moved;
    }

    public function getLastUploadedItem()
    {
        var_dump($this->uploadItems);
        return end($this->uploadItems);
    }

    public function getLastUploadedFilename()
    {
        $item = $this->getLastUploadedItem();

        return $item['full_result_filename'];
    }

    /**
     * @param array $permitted
     */
    public function setPermitted(array $permitted)
    {
        $this->permitted = $permitted;
    }

    /**
     * @param $permitted
     */
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

    public function getFullPath()
    {
        return $this->rootFolder . $this->uploadFolder;
    }

    public function createUploadFolder()
    {
        return $this->FS->createDirectory($this->getFullPath());
    }

    /**
     * Manipulate the item if required. Just override this method and return the manipulated $item.
     *
     * @param array $item
     * @return array
     */
    protected function manipulate(array $item)
    {
        return $item;
    }

    protected function move(array $item)
    {
        return move_uploaded_file($item['tmp_name'], $this->getFullPath() . $item['name']);
    }

    protected function validate(array $item)
    {
        if (!$this->ValidateUploadField->validate($item)) {
            return false;
        }

        if (!$this->FS->isFile($item['tmp_name'])) {
            return false;
        }

        if ($item['error'] !== 0) {
            return false;
        }

        return true;
    }

    protected function isPermitted(array $item)
    {
        $ok = false;

        if ($this->permitted === false || !is_array($this->permitted)) {
            return true;
        }

        if (count($this->permitted) == 0) {
            return true;
        }

        foreach ($this->permitted as $permitted) {
            if ($permitted == $item['type']) {
                $ok = true;
            }
        }

        return $ok;
    }
}