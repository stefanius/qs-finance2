<?php
class Grootboek extends AppModel
{
    public $name = 'Grootboek';
    public $displayField = 'display_omschrijving';
    public $order = "nummer asc";
    public $recursive=-1;
    public $virtualFields = array(
                            'display_omschrijving' => "CONCAT('', Grootboek.nummer, ' - ', Grootboek.omschrijving)",
                            'rektype' =>  "CONCAT(Grootboek.winstverlies)");

    public $validate = array(
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

    public $hasMany = array(
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

    public $hasOne = array(
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

    public function getPosten($type=null)
    {
            $this->recursive=-1;
            if (isset($type)) {
                if ($type ==0 || $type ==1) {
                    $posten = $this->find('all', array('conditions' => array('winstverlies' => $type)));
                } elseif ($type==2) {
                    $posten = $this->find('all', array('conditions' => array('liquide' => 1)));
                }

            } else {
                $posten = $this->find('all');
            }

            return $posten;
    }

    public function getById($id)
    {
        $grootboek = $this->find('first', array('conditions' => array ('id' => $id)));
        if ($grootboek==null) {
            $grootboek = $this->onbekend($id);
        }

        return $grootboek;
    }

    public function getByNummer($nummer)
    {
        $grootboek = $this->find('first', array('conditions' => array ('nummer' => $nummer)));
        if ($grootboek==null) {
            $grootboek = $this->onbekend($nummer);
        }

        return $grootboek;
    }

    public function onbekend($key)
    {
        $grootboek['Grootboek']['nummer'] = $key;
        $grootboek['Grootboek']['id'] = $key;
        $grootboek['Grootboek']['display_omschrijving'] = "*$key*: ID/nummer is onbekend. Grootboek is niet gevonden";
        $grootboek['Grootboek']['omschrijving'] = "ID/nummer is onbekend. Grootboek is niet gevonden";
        $grootboek['Grootboek']['debet'] = -1;
        $grootboek['Grootboek']['credit'] = -1;
        $grootboek['Grootboek']['debetcredit'] = "N/A";

        return $grootboek;
    }

    public function get($key)
    {
        $this->recursive = -1;
        if (strlen($key)==4) {
            $grootboek=$this->getByNummer($key);
        } elseif (strlen($key)==36) {
            $grootboek=$this->getById($key);
        } else {
            $grootboek = $this->onbekend($key);
        }

        return $grootboek;
    }

    public function getSaldi($bookyear_id, $grootboek_key,$beginbalans=null, $date=null)
    {
        $grootboek = $this->get($grootboek_key);
        $grootboek_id = $grootboek['Grootboek']['id'];
        $calculations = $this->Calculation->getCalculations($bookyear_id, $grootboek_id,$beginbalans, $date);
        $debet=0;
        $credit=0;
        $saldo=0;
        foreach ($calculations as $calc) {
            $debet += $calc['Calculation']['debet'];
            $credit += $calc['Calculation']['credit'];
        }
        $grootboek['Journaal'] = $calculations;
        $grootboek['Bedrag'] = $this->calculate($debet, $credit, $grootboek['Grootboek']['debetcredit']);
        $grootboek['Bedrag']['omschrijving'] = "TOTAAL";

        return $grootboek;
    }

    public function calculate($debet, $credit, $balanszijde)
    {
                $debet=(float) sprintf('%s', $debet);
                $credit=(float) sprintf('%s', $credit);
        $saldo=0.00;
        if ($balanszijde=='debet') {
            $saldo = $debet-$credit;
        }

        if ($balanszijde=='credit') {
            $saldo = $credit-$debet;
        }

        $rtrnsaldo['debet'] = $debet;
        $rtrnsaldo['credit'] = $credit;
        $rtrnsaldo['saldo'] = $saldo;
                if ($rtrnsaldo['saldo'] == -0 || $rtrnsaldo['saldo'] == -0.00) {
                    $rtrnsaldo['saldo']=0;
                }

        return $rtrnsaldo;
    }

    public function afterFind($results, $primary=false)
    {
        if ($results) {
            foreach ($results as $key => $val) {
                if (isset($val['Grootboek'])) {
                    if (isset($val['Grootboek']['winstverlies'])) {
                        if ($val['Grootboek']['winstverlies'] == 0) {
                            $results[$key]['Grootboek']['rektype'] = 'balans';
                        } elseif ($val['Grootboek']['winstverlies'] == 1) {
                            $results[$key]['Grootboek']['rektype'] = 'resultaat';
                        } else {
                            $results[$key]['Grootboek']['rektype'] = 'error';
                        }
                    }
                }
            }
        }

        return $results;
    }
}
