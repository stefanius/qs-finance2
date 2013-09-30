<?php

App::uses('Component', 'Controller', 'ImportComponent');
class ImportRaboCsvComponent extends ImportComponent {
        
    public function execute($filename = null, $source = null, $type = null){
    	throw new NotImplementedException('RaboCSV import Not implemented yet');
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
