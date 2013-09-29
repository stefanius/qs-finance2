<?php

App::uses('Component', 'Controller');
class ImportComponent extends Component {
    
    public $components = array('Csv');
    public $helpers = array('Form', 'Html', 'Number',  'Balans');
    
    public function execute($filename = null, $source = null, $type = null){
        $data = array();
        $sourceinfo = array();
        if(is_null($filename) || is_null($source) || is_null($type)){
            throw new CakeException();
        }
        
        if($source == 'ing' && $type == 'csv'){
            $this->Csv->setFirstLineAsHeader(true);
            $this->Csv->setUseHeaderAsKey(false);
            $csvdata =  $this->Csv->read($filename);
            
            foreach($csvdata as $key=>$datarow){
                $data[$key]['boekdatum'] = $datarow[0];
                $data[$key]['omschrijving'] = preg_replace('/\s+/', ' ', $datarow[1]) ;
                
                $sourceinfo['rekening'] = $datarow[2];
                
                if(strlen(trim($datarow[8])) > 5){
                	$data[$key]['omschrijving'] = preg_replace('/\s+/', ' ', $datarow[8]) ;
                }
                
                if($datarow[5] === 'Af'){
                    $data[$key]['credit'] = str_replace(',', '.', $datarow[6]) ;
                    $data[$key]['debet'] = 0;
                }else{
                    $data[$key]['debet'] =  str_replace(',', '.', $datarow[6]) ;
                    $data[$key]['credit'] = 0;                    
                }
            }
        }
        $rtrn = array();
        $rtrn['data']  = $data;
        $rtrn['sourceinfo']  = $sourceinfo;
        return $rtrn;
    } 


/*
  0 => string 'Datum' (length=5)
  1 => string 'Naam / Omschrijving' (length=19)
  2 => string 'Rekening' (length=8)
  3 => string 'Tegenrekening' (length=13)
  4 => string 'Code' (length=4)
  5 => string 'Af Bij' (length=6)
  6 => string 'Bedrag (EUR)' (length=12)
  7 => string 'MutatieSoort' (length=12)
  8 => string 'Mededelingen' (length=12)
 */
}
?>
