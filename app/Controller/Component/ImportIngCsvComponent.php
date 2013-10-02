<?php

App::uses('Component', 'ImportComponent');
class ImportIngCsvComponent extends ImportComponent {
        
    public function execute($filename = null, $source = null, $type = null){
        $data = array();
        $sourceinfo = array();
        if(is_null($filename) || is_null($source) || is_null($type)){
            throw new CakeException();
        }
            $this->Csv->setFirstLineAsHeader(true);
            $this->Csv->setUseHeaderAsKey(false);
            $csvdata =  $this->Csv->read($filename);
            
            foreach($csvdata as $key=>$datarow){
                $data[$key]['boekdatum'] = $datarow[0];
                $data[$key]['omschrijving'] = preg_replace('/\s+/', ' ', $datarow[1]) ;
                
                if(strlen($data[$key]['boekdatum']) == 8){
                	$year = substr($data[$key]['boekdatum'], 0,4);
                	$month = substr($data[$key]['boekdatum'], 4,2);
                	$day = substr($data[$key]['boekdatum'], 6,2);
                	$data[$key]['boekdatum'] = $year.'-'.$month.'-'.$day;
                }elseif(strlen($data[$key]['boekdatum']) == 10){
                	$explodeDate = explode('-', $data[$key]['boekdatum']);
                	if(strlen($explodeDate[2]) ==4){
                		$year=$explodeDate[2];
                		$month=$explodeDate[1];
                		$day=$explodeDate[0];
                		$data[$key]['boekdatum'] = $year.'-'.$month.'-'.$day;
                	}
                }
                
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
