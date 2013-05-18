<?php
class Bookyear extends AppModel {
	var $name = 'Bookyear';
	var $displayField = 'omschrijving';
	var $order = 'startdatum DESC';
	var $virtualFields = array('balansdatum' =>  "CURDATE()");
	var $validate = array(
		'startdatum' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'einddatum' => array(
			'date' => array(
				'rule' => array('date'),
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
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Calculation' => array(
			'className' => 'Calculation',
			'foreignKey' => 'bookyear_id',
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

	function closebookyear($bookyear = null) {
		if (!$bookyear) {
			$this->Session->setFlash(__('Invalid id for bookyear', true));
		}
		$this->read(null, $bookyear['Bookyear']['id']);
		$this->set('closed', 1);
		$this->save();
	}

	function getById($id){
		$bookyear = $this->find('first', array('conditions' => array ('id' => $id)));
		if($bookyear==null){
			$bookyear = $this->onbekend($id);
		}
		return $bookyear;
	}
	
	function getByOmschrijving($omschrijving){
		$bookyear = $this->find('first', array('conditions' => array ('omschrijving' => $omschrijving)));
		if($bookyear==null){
			$bookyear = $this->onbekend($omschrijving);
		}
		return $bookyear;
	}
	
	function onbekend($key){
		$bookyear['Bookyear']['id'] = $key;
		$bookyear['Bookyear']['omschrijving'] = "ID/omschrijving is onbekend. Boekjaar is niet gevonden";
		return $bookyear;
	}
	
	function get($key){
		if(strlen($key)==36){
			$bookyear=$this->getById($key);
		}else{
			$bookyear = $this->getByOmschrijving($key);
		}
		return $bookyear;
	}
}
?>