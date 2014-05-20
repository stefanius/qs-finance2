<?php
App::uses('UploadAndAnonimizeFilenameComponent', 'StefUpload.Controller/Component');

class UploadImportFileComponent extends UploadAndAnonimizeFilenameComponent {

    protected $uploadFolder = 'upload/import/';

}