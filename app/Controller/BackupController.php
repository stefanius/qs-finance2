<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class BackupController extends AppController {
    
    var $name = 'Backup';
    var $uses = array();

    function downloadmysql($filename=false){
        $path=WWW_ROOT . DS . 'files' . DS . 'mysqlbackup' . DS;
        if($filename===false){
            $dir = new Folder($path);
            $files = $dir->find('.*\.gz');
            sort($files);
            $files=array_reverse($files);
            $this->set(compact('files'));
        }else{
            $this->viewClass = 'Media';
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $basename = str_replace('.'.$ext, '', $filename );
            $params = array(
                'id'        => $filename,
                'name'      => $basename,
                'download'  => true,
                'extension' => $ext,
                'path'      => $path
            );
            $this->set($params);           
        }
    }    
}

