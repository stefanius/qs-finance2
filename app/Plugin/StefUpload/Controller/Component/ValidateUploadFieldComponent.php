<?php
App::uses('Component', 'Controller');

class ValidateUploadFieldComponent extends Component {

    /**
     * @param $item
     * @return bool
     */
    public function validate($item)
    {
        if (!is_array($item)) {
            return false;
        }

        if (count($item) !== 5) {
            return false;
        }

        if (!array_key_exists('name', $item)) {
            return false;
        }

        if (!array_key_exists('type', $item)) {
            return false;
        }

        if (!array_key_exists('tmp_name', $item)) {
            return false;
        }

        if (!array_key_exists('error', $item)) {
            return false;
        }

        if (!array_key_exists('size', $item)) {
            return false;
        }

        return true;
    }
}
