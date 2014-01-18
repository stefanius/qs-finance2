<?php

App::uses('Component', 'Controller');
class ImportComponent extends Component
{
    public $components = array('Csv');
    public $helpers = array('Form', 'Html', 'Number',  'Balans');
    protected $foundAccountNumbers = array();

    public function execute($filename = null, $source = null, $type = null)
    {
    }
    
    protected function setAccountNumbers($iban){
    	$this->foundAccountNumbers[$iban] = $iban;
    }
    
    protected function getAccountNumbers(){
    	return $this->foundAccountNumbers;
    }
}
