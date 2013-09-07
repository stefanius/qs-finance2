<?php
class Grootboek extends AppModel {
	var $name = 'Grootboek';
	var $displayField = 'display_omschrijving';
	var $order = "nummer asc";
	var $recursive=-1;
	var $virtualFields = array(
							'display_omschrijving' => "CONCAT('', Grootboek.nummer, '- ', Grootboek.omschrijving)",
							'rektype' =>  "CONCAT(Grootboek.winstverlies)");
	
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
		'debetcredit' => array(
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
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Calculation' => array(
			'className' => 'Calculation',
			'foreignKey' => 'grootboek_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $hasOne = array(
		'Bookyear' => array(
			'className' => 'Bookyear',
			'foreignKey' => '',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function getPosten($type=null){
            $this->recursive=-1;
            if(isset($type)){
                if($type ==0 || $type ==1){
                    $posten = $this->find('all', array('conditions' => array('winstverlies' => $type)));
                }elseif($type==2){
                    $posten = $this->find('all', array('conditions' => array('liquide' => 1)));
                }
                
            }else{
                $posten = $this->find('all');
            }
            return $posten;
	}
	
	function getById($id){
		$grootboek = $this->find('first', array('conditions' => array ('id' => $id)));
		if($grootboek==null){
			$grootboek = $this->onbekend($id);
		}
		return $grootboek;
	}

	function getByNummer($nummer){
		$grootboek = $this->find('first', array('conditions' => array ('nummer' => $nummer)));
		if($grootboek==null){
			$grootboek = $this->onbekend($nummer);
		}
		return $grootboek;
	}
	
	function onbekend($key){
		$grootboek['Grootboek']['nummer'] = $key;
		$grootboek['Grootboek']['id'] = $key;
		$grootboek['Grootboek']['display_omschrijving'] = "*$key*: ID/nummer is onbekend. Grootboek is niet gevonden";
		$grootboek['Grootboek']['omschrijving'] = "ID/nummer is onbekend. Grootboek is niet gevonden";
		$grootboek['Grootboek']['debet'] = -1;
		$grootboek['Grootboek']['credit'] = -1;
		$grootboek['Grootboek']['debetcredit'] = "N/A";
		return $grootboek;		
	}
	
	function get($key){
		$this->recursive = -1;
		if(strlen($key)==4){
			$grootboek=$this->getByNummer($key);
		}elseif(strlen($key)==36){
			$grootboek=$this->getById($key);
		}else{
			$grootboek = $this->onbekend($key);
		}	
		return $grootboek;
	}

	function getSaldi($bookyear_id, $grootboek_key,$beginbalans=null){
		$grootboek = $this->get($grootboek_key);
		$grootboek_id = $grootboek['Grootboek']['id'];
		$calculations = $this->Calculation->getCalculations($bookyear_id, $grootboek_id,$beginbalans);
		$debet=0;
		$credit=0;
		$saldo=0;	
		
		foreach($calculations as $calc){
			$debet += $calc['Calculation']['debet'];
			$credit += $calc['Calculation']['credit'];
		}		
		$grootboek['Journaal'] = $calculations;
		$grootboek['Bedrag'] = $this->calculate($debet, $credit, $grootboek['Grootboek']['debetcredit']);
		$grootboek['Bedrag']['omschrijving'] = "TOTAAL";
		return $grootboek;
	}
	
	function calculate($debet, $credit, $balanszijde){
                $debet=(float) sprintf('%s', $debet);
                $credit=(float) sprintf('%s', $credit);
		$saldo=0.00;
		if($balanszijde=='debet'){
			$saldo = $debet-$credit;
		}

		if($balanszijde=='credit'){
			$saldo = $credit-$debet;
		}
		
		$rtrnsaldo['debet'] = $debet;
		$rtrnsaldo['credit'] = $credit;
		$rtrnsaldo['saldo'] = $saldo;
                if($rtrnsaldo['saldo'] == -0 || $rtrnsaldo['saldo'] == -0.00){
                    $rtrnsaldo['saldo']=0;
                }
		return $rtrnsaldo;
	}

	function afterFind($results, $primary=false) {
		if($results){
			foreach ($results as $key => $val) {
				if(isset($val['Grootboek'])){
					if(isset($val['Grootboek']['winstverlies'])){
						if ($val['Grootboek']['winstverlies'] == 0) {
							$results[$key]['Grootboek']['rektype'] = 'balans';
						}else if ($val['Grootboek']['winstverlies'] == 1) {
							$results[$key]['Grootboek']['rektype'] = 'resultaat';
						}else{
							$results[$key]['Grootboek']['rektype'] = 'error';
						}
					}
				}
			}			
		}
		return $results;
	}	
}
?>