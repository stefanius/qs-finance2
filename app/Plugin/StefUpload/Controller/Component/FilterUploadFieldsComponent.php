<?php
App::uses('Component', 'Controller');

class FilterUploadFieldsComponent extends Component {

    public $components = ['StefUpload.ValidateUploadField'];

    /**
     * @param array $requestdata
     * @return array
     */
    public function filter(array $requestdata)
    {
        $uploadfields = [];

        foreach ($requestdata as $key => $value) {
            if ($this->ValidateUploadField->validate($value) ) {
                $uploadfields[$key] = $value;
            }
        }

        return $uploadfields;
    }
}
