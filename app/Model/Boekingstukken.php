<?php
class Boekingstukken extends AppModel
{
    public $name = 'Boekingstukken';
    public $displayField = 'boekingstuk';
    public $validate = array(
        'boekinstuk' => array(
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

    public function getBoekingstukken($bookyear)
    {
        $calculation_model = ClassRegistry::init('Calculation');
        $bookyear_model = ClassRegistry::init('Bookyear');
        $bookyr = $bookyear_model->get($bookyear);
        $stukken = $calculation_model->find('all',
                                                array(
                                                    'conditions' => array('bookyear_id' => $bookyr['Bookyear']['id']),
                                                    'fields' => array('DISTINCT Calculation.boekingstuk'),
                                                    'order' => array('Calculation.created DESC')
                                                    )
                                            );

        return $stukken;
    }
    public function retrieve($bookyear_id, $number)
    {
        $bookyear_model = ClassRegistry::init('Bookyear');
        $bookyear_model->recursive = -1;
        $bookyear = $bookyear_model->get($bookyear_id);
        $lst = $this->create_new_stukken($bookyear_id, $bookyear['Bookyear']['omschrijving']);

        return $lst[$number];
    }

    public function create_new_stukken($bookyear_id, $bookyear_omschrijving=null)
    {
        $stukken_tpl = $this->find('all');
        $i=0;

        $bookyear_omschrijving = str_replace("-", "", $bookyear_omschrijving);

        foreach ($stukken_tpl as $stuk) {
            $a = $this->query("SELECT COUNT(DISTINCT boekingstuk) AS aantal FROM calculations WHERE bookyear_id='".$bookyear_id."' AND boekingstuk LIKE '".$stuk['Boekingstukken']['boekingstuk']."-%'" );
            if ($a[0][0]['aantal'] > 1) {
                $nieuwe_stukken[$i] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.($a[0][0]['aantal']+1);
                $nieuwe_stukken[$i+1] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.$a[0][0]['aantal'];
                $nieuwe_stukken[$i+2] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.($a[0][0]['aantal']-1);
                $i = $i+3;
            } elseif ($a[0][0]['aantal'] > 0) {
                $nieuwe_stukken[$i] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.($a[0][0]['aantal']+1);
                $nieuwe_stukken[$i+1] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.$a[0][0]['aantal'];
                $i = $i+3;
            } else {
                $nieuwe_stukken[$i] = $stuk['Boekingstukken']['boekingstuk'].'-'.$bookyear_omschrijving.'-'.($a[0][0]['aantal']+1);
                $i = $i+1;
            }
        }

        return $nieuwe_stukken;
    }
}
