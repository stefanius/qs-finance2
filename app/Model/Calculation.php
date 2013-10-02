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

    public function getCalculations($bookyear_id, $grootboek_id,$beginbalans=null)
    {
        if (isset($beginbalans)) {
            $calculations = $this->find('all', array('conditions' => array('bookyear_id' => $bookyear_id, 'grootboek_id' => $grootboek_id, 'beginbalans' => $beginbalans)));
        } else {
            $calculations = $this->find('all', array('conditions' => array('bookyear_id' => $bookyear_id, 'grootboek_id' => $grootboek_id)));
        }

        return $calculations;
    }

    public function getBoekingstukken($bookyear_id)
    {
        $stukken = $this->find('all', array('fields' => array('DISTINCT Calculation.boekingstuk'),'conditions' => array('bookyear_id' => $bookyear_id)));

        return $stukken;
    }

    public function getByBoekingsstuk($boekingstuk)
    {
        $this->recursive =1;
        $calcs = $this->find('all', array('conditions' => array('boekingstuk' => $boekingstuk)));

        for ($i=0;$i<count($calcs);$i++) {
            $calcs[$i]['Calculation']['omschrijving'] = '('. $calcs[$i]['Grootboek']['nummer'].') '.$calcs[$i]['Calculation']['omschrijving'];
        }

        return $calcs;
    }
}
