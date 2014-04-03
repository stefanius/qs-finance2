<?php
class BalansController extends AppController
{
    public $name = 'Balans';
    public $uses = 'Balans';

    public $helpers = array('Form', 'Html', 'Number',  'Balans');

    public function beforeFilter()
    {
        parent::beforeFilter();
        //$this->Auth->allow(array('*'));
    }

    public function index()
    {
        $beginbalans = null;
        $open_timemachine = false;
        $bookyear_key = $this->request->params['bookyear_key'];
        $date = null;
        $timemachine_date = date('d-m-Y');
        if (isset($this->request->query['date'])) {
            if (strlen($this->request->query['date']) == 10) {
                $tmp = explode('-',$this->request->query['date']);

                if (count($tmp) == 3) {
                    if (strlen($tmp[0]) == 2 && strlen($tmp[1]) ==2 && strlen($tmp[2]) == 4 ) {
                        $date = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
                    } elseif (strlen($tmp[2]) == 2 && strlen($tmp[1]) ==2 && strlen($tmp[0]) == 4 ) {
                        $date = $tmp[0].'-'.$tmp[1].'-'.$tmp[2];
                    }
                }
            }
        }

        if ($date !== null) {
            $timemachine_date = date('d-m-Y', strtotime($date));
            $open_timemachine = true;
        }

        $balans = $this->Balans->openBalans($bookyear_key, $beginbalans, $date);
        $balans = $this->Balans->formatBalans($balans);
        $bookyear = $this->Balans->Bookyear->get($bookyear_key);
        $this->Session->write('Bookyear', $bookyear['Bookyear']);

        $this->set(compact('balans', 'bookyear', 'timemachine_date', 'open_timemachine'));
    }

    public function open($bookyear_key, $beginbalans=null)
    {
        $balans = $this->Balans->openBalans($bookyear_key, $beginbalans);
        $balans = $this->Balans->formatBalans($balans);
        $bookyear = $this->Balans->Bookyear->get($bookyear_key);
        $this->Session->write('Bookyear', $bookyear['Bookyear']);

        $this->set(compact('balans', 'bookyear'));
    }

    public function kolombalans()
    {
        $bookyear = array();
        $bookyear['Bookyear'] = $this->checkSessionHasBookyear();
        $kolombalans = $this->Balans->openKolomBalans($bookyear['Bookyear']['omschrijving']);
        $this->set(compact('kolombalans'));
    }

    public function newbalans($oldbookyear, $newbookyear)
    {
        $this->Balans->newbalans($oldbookyear, $newbookyear);
        $bookyear = $this->Balans->Bookyear->get($newbookyear);
        $this->redirect(array('controller' => 'balans', 'action' => 'open', $bookyear['Bookyear']['omschrijving']));
    }
}
