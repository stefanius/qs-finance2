<?php
App::uses('Component', 'Controller');

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
        $path       = $this->getFullPath($subfolder);
        $createPath = '';

        if (!is_dir($path)) {
            $folderArr = explode("/", $path);

            for ($i=0;$i<count($folderArr);$i++) {
                $createPath .= $folderArr[$i] . "/";

                if (!is_dir($fullFolder)) {
                    mkdir($fullFolder);
                }
            }
            $folder_url=$fullFolder;
        }
    }

    public function execute($formdata, $itemId = null)
    {
        // setup dir names absolute and relative
        $folder_url = WWW_ROOT.$folder;
        $rel_url = $folder;

        // create the folder if it does not exist


        // if itemId is set create an item folder
        if ($itemId) {
            // set new absolute folder
            $folder_url = WWW_ROOT.$folder.'/'.$itemId;
            // set new relative folder
            $rel_url = $folder.'/'.$itemId;
            // create directory
            if (!is_dir($folder_url)) {
                mkdir($folder_url);
            }
        }

        // list of permitted file types, this is only images but documents can be added
        $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');

        // loop through and deal with the files
        foreach ($formdata as $file) {
            // replace spaces with underscores
            $filename = str_replace(' ', '_', $file['name']);
            // assume filetype is false
            $typeOK = false;
            // check filetype is ok
            $typeOK = true;
            /*
            foreach ($permitted as $type) {

                if ($type == $file['type']) {
                    $typeOK = true;
                    break;
                }
            }*/

            // if file type ok upload the file
            if ($typeOK) {
                // switch based on error code
                switch ($file['error']) {
                    case 0:
                        // check filename already exists
                        if (!file_exists($folder_url.'/'.$filename)) {
                            // create full filename
                            $full_url = $folder_url.'/'.$filename;
                            $url = $rel_url.'/'.$filename;
                            // upload the file
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        } else {
                            // create unique filename and upload file
                            ini_set('date.timezone', 'Europe/London');
                            $now = date('Y-m-d-His');
                            $full_url = $folder_url.'/'.$now.$filename;
                            $url = $rel_url.'/'.$now.$filename;
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        }
                        // if upload was successful
                        if ($success) {
                            // save the url of the file
                            $result['urls'][] = $url;
                        } else {
                            $result['errors'][] = "Error uploaded $filename. Please try again.";
                        }
                        break;
                    case 3:
                        // an error occured
                        $result['errors'][] = "Error uploading $filename. Please try again.";
                        break;
                    default:
                        // an error occured
                        $result['errors'][] = "System error uploading $filename. Contact webmaster.";
                        break;
                }
            } elseif ($file['error'] == 4) {
                // no file was selected for upload
                $result['nofiles'][] = "No file Selected";
            } else {
                // unacceptable file type
                $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
            }
        }

        return $result;
    }
}