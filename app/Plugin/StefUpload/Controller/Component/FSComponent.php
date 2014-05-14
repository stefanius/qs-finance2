<?php
App::uses('Component', 'Controller');

class FSComponent extends Component {

    protected $lastcreated = null;

    public function createDirectory($path)
    {
        $createPath = '';

        if ($this->isDir($path)) {
            return true;
        }

        $folderArr = explode("/", $path);
        $result = false;
        
        foreach ($folderArr as $value) {
            $createPath .= $value . "/";

            if (!$this->isDir($createPath)) {
                mkdir($createPath);
                $this->lastcreated = $createPath;
            }
        }

        if ($this->lastcreated === $path) {
            $result = true;
        }

        return $result;
    }

    public function isDir($path)
    {
        return is_dir($path);
    }

    public function split($path)
    {
        return explode("/", $path);
    }

    public function getLastCreated()
    {
        return $this->lastcreated;
    }
}