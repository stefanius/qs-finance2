<?php

class ExportexcelController extends AppController
{
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Exportexcel';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
    public $helpers = array('PhpExcel', 'ExportKolomBalans');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
    public $uses = array('Balans', 'Calculation', 'Bookyear', 'Grootboek' );

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
    public function index()
    {
    }

    public function balans()
    {
        $bookyear = $this->checkSessionHasBookyear();
        $balans = $this->Balans->openBalans($bookyear['omschrijving']);
        $balans = $this->Balans->formatBalans($balans);
        $data=$balans;
        $templatepath = $this->essential();
        $file = $templatepath.'balans.xls';
        $this->set(compact('balans', 'data','file'));
    }

    public function kolombalans()
    {
        $bookyear = $this->checkSessionHasBookyear();
        $balans = $this->Balans->openKolomBalans($bookyear['omschrijving']);
        $liquideposten = $this->Balans->retrieveLiquidePosten($bookyear['omschrijving']);
        $data=$balans;
        $this->set(compact('balans', 'data', 'liquideposten'));
    }

    public function essential()
    {
        return  WWW_ROOT . DS . 'files' . DS . 'xsltemplates' . DS . 'balans' . DS;
    }
}
