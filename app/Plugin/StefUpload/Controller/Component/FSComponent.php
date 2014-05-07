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

        foreach ($folderArr as $value) {
            $createPath .= $value . "/";

            if (!$this->isDir($createPath)) {
                mkdir($createPath);
                $this->lastcreated = $createPath;
            }
        }
    }

    public function isDir($path)
    {
        return is_dir($path);
    }

    public function split($path)
    {
        return explode("/", $path);
    }
}