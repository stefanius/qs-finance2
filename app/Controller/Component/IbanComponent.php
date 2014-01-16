<?php

App::uses('Component', 'Controller');
class IbanComponent extends Component
{
    public $components = array('Csv');
    public $helpers = array('Form', 'Html', 'Number',  'Balans');

    public function convert($iban)
    {
    	$validated = false;
    	$result = array();
    	$iban = trim($iban);
    	if(preg_match('|(?P<countrycode>[a-zA-Z]{2})(?P<controlnumber>[0-9]{2})(?P<brand>[a-zA-Z0-9]{4})(?P<bankaccount>[0-9]{7}([a-zA-Z0-9]?){0,16})|', $iban, $matches)){
    		$result = $matches;
    		$validated = true;
    	}
    	$result['validated'] = $validated;
    	$result['fulliban'] = $iban;
    	return $result;
    }

}
