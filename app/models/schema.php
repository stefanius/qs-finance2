<?php
class Schema extends AppModel {
	var $name = 'Schema';
	var $displayField = 'nummer';
	var $validate = array(
		'nummer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'omschrijving' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	function getpatterns(){
		return $this->query("SELECT `nummer`, `omschrijving` FROM `schemas`");
	}

	function matchpatterns($pattern='xxxx'){
		$pattern_wildcards = str_replace('x', '_', $pattern);
		$result = $this->query("SELECT * FROM `grootboeks` where `nummer` like '$pattern_wildcards'");
		$i=0;
		foreach ($result as $item){
			if($item['grootboeks']['winstverlies']==1){
				$result[$i]['grootboeks']['type'] = 'Resultaat';
			}else{
				$result[$i]['grootboeks']['type'] = 'Balans ('.$item['grootboeks']['debetcredit'].')';
			}
			$i++;
		}
		
		return $result;
	}
	
}
?>