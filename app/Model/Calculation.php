<?php
class Calculation extends AppModel
{
	public $recursive =-1;
	public $name = 'Calculation';
	var $order = "boekdatum desc";
	public $displayField = 'omschrijving';
	public $validate = array(
			'grootboek_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'bookyear_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'user_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'allowEmpty' => false,
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
			'boekdatum' => array(
					'date' => array(
							'rule' => array('date'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
			'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
			'Grootboek' => array(
					'className' => 'Grootboek',
					'foreignKey' => 'grootboek_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
			'Bookyear' => array(
					'className' => 'Bookyear',
					'foreignKey' => 'bookyear_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	public function getCalculations($bookyear_id, $grootboek_id,$beginbalans=null, $date=null)
	{
		$conditions = array('conditions' => array('bookyear_id' => $bookyear_id, 'grootboek_id' => $grootboek_id));
		
		if (isset($beginbalans)) {
			$conditions['conditions']['beginbalans'] = $beginbalans;
		} 
		
		if (isset($date)) {
			$conditions['conditions']['boekdatum <= '] = $date;
		}

		$calculations = $this->find('all', $conditions);
		return $calculations;
	}

}
