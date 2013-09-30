<?php

App::uses('Component', 'Controller');
class ImportComponent extends Component {
    
    public $components = array('Csv');
    public $helpers = array('Form', 'Html', 'Number',  'Balans');
    
    public function execute($filename = null, $source = null, $type = null){

    } 

}
?>
