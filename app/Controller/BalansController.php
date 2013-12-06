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
    	$bookyear_key = $this->request->params['bookyear_key'];
    	    	
        $balans = $this->Balans->openBalans($bookyear_key, $beginbalans);
        $balans = $this->Balans->formatBalans($balans);
        $bookyear = $this->Balans->Bookyear->get($bookyear_key);
        $this->Session->write('Bookyear', $bookyear['Bookyear']);

        $this->set(compact('balans', 'bookyear'));
    }

    public function open($bookyear_key, $beginbalans=null)
    {
        $balans = $this->Balans->openBalans($bookyear_key, $beginbalans);
        $balans = $this->Balans->formatBalans($balans);
        $bookyear = $this->Balans->Bookyear->get($bookyear_key);
        $this->Session->write('Bookyear', $bookyear['Bookyear']);
        
        $this->set(compact('balans', 'bookyear'));
    }

    public function kolombalans($bookyear)
    {
        $kolombalans = $this->Balans->openKolomBalans($bookyear);
        $this->set(compact('kolombalans'));
    }

    public function newbalans($oldbookyear, $newbookyear)
    {
        $this->Balans->newbalans($oldbookyear, $newbookyear);
        $bookyear = $this->Balans->Bookyear->get($newbookyear);
        $this->redirect(array('controller' => 'balans', 'action' => 'open', $bookyear['Bookyear']['omschrijving']));
    }
}
