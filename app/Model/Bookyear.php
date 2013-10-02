<?php
class Bookyear extends AppModel
{
    public $name = 'Bookyear';
    public $displayField = 'omschrijving';
    public $order = 'startdatum DESC';
    public $virtualFields = array('balansdatum' =>  "CURDATE()");
    public $validate = array(
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

    public $hasMany = array(
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

    public function closebookyear($bookyear = null)
    {
        if (!$bookyear) {
            $this->Session->setFlash(__('Invalid id for bookyear'));
        }
        $this->read(null, $bookyear['Bookyear']['id']);
        $this->set('closed', 1);
        $this->save();
    }

    public function getById($id)
    {
        $bookyear = $this->find('first', array('conditions' => array ('id' => $id)));
        if ($bookyear==null) {
            $bookyear = $this->onbekend($id);
        }

        return $bookyear;
    }

    public function getByOmschrijving($omschrijving)
    {
        $bookyear = $this->find('first', array('conditions' => array ('omschrijving' => $omschrijving)));
        if ($bookyear==null) {
            $bookyear = $this->onbekend($omschrijving);
        }

        return $bookyear;
    }

    public function onbekend($key)
    {
        $bookyear['Bookyear']['id'] = $key;
        $bookyear['Bookyear']['omschrijving'] = "ID/omschrijving is onbekend. Boekjaar is niet gevonden";

        return $bookyear;
    }

    public function get($key)
    {
        if (strlen($key)==36) {
            $bookyear=$this->getById($key);
        } else {
            $bookyear = $this->getByOmschrijving($key);
        }

        return $bookyear;
    }
}
