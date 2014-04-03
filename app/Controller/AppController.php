<?php

class AppController extends Controller
{
    //var $components = array('Acl', 'Auth', 'Session');
    //var $helpers = array('Html', 'Form', 'Session');

    public $components = array(

        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authError' => 'Om acties in het systeem uit te voeren moet u zijn ingelogd!',
        )

    );

    public function beforeFilter()
    {
        $this->Auth->autoRedirect = false;
        //$this->Auth->allowedActions = array('display');
        $this->Auth->actionPath = 'controllers/';
    }

    /**
     * uploads files to the server
     * @params:
     *		$folder 	= the folder to upload the files e.g. 'img/files'
     *		$formdata 	= the array containing the form files
     *		$itemId 	= id of the item (optional) will create a new sub folder
     * @return:
     *		will return an array with the success of each file upload
     */
    public function uploadFiles($folder, $formdata, $itemId = null)
    {
        // setup dir names absolute and relative
        $folder_url = WWW_ROOT.$folder;
        $rel_url = $folder;

        // create the folder if it does not exist
        if (!is_dir($folder_url)) {
            $folderArr = explode("/",$folder_url);
            $fullFolder="";
            for ($i=0;$i<count($folderArr);$i++) {
                $fullFolder .= $folderArr[$i]."/";

                if (!is_dir($fullFolder)) {
                    mkdir($fullFolder);
                }
            }
            $folder_url=$fullFolder;
        }

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

    public function checkSessionHasBookyear()
    {
        if ($this->Session->check('Bookyear')) {
            return $this->Session->read('Bookyear');
        } else {
            $this->Session->setFlash(__('Er is geen bookjaar geselecteerd.'));
            $this->redirect('/');
        }
    }

}
