<?php
App::uses('UploadComponent', 'StefUpload.Controller/Component');

class UploadAndAnonimizeFilenameComponent extends UploadComponent {

    /**
     * Manipulate the item if required. Just override this method and return the manipulated $item.
     *
     * @param array $item
     * @return array
     */
    protected function manipulate(array $item)
    {
        $item['name'] = String::uuid($item['name']);
        return $item;
    }
}