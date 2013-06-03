<?php

$this->PhpExcel->loadWorksheet("C:/wamp/www/qs-finance/app/controllers/components/phpexcel/run/templates/balans.xls"); 
$this->PhpExcel->setRow(1);
$this->PhpExcel->addData(array('A'=> 'Balans: '.$data['Bookyear']['omschrijving']));

$this->PhpExcel->setRow(3);
foreach($data['debet']['posten'] as $r => $dataRow) {
    $this->PhpExcel->addDataRow(array('A'=>$dataRow['Grootboek']['nummer'], 'B'=>$dataRow['Grootboek']['omschrijving'], 'E'=> $dataRow['Bedrag']['saldo']));
}

$this->PhpExcel->addDataRow(array('B'=>'TOTAAL', 'E'=> $data['debet']['totaal']));

$this->PhpExcel->setRow(3);
$this->PhpExcel->addDataRow(array('F'=>'EV', 'G'=>'Eigen Vermogen', 'J'=> $data['ev']));

foreach($data['credit']['posten'] as $r => $dataRow) {
    $this->PhpExcel->addDataRow(array('F'=>$dataRow['Grootboek']['nummer'], 'G'=>$dataRow['Grootboek']['omschrijving'], 'J'=> $dataRow['Bedrag']['saldo']));
}

$this->PhpExcel->addDataRow(array('G'=>'TOTAAL', 'J'=> $data['credit']['totaal']));

$rowpointer = $this->PhpExcel->getRow()-1;
$this->PhpExcel->setBold('B'.$rowpointer);
$this->PhpExcel->setBold('E'.$rowpointer);
$this->PhpExcel->setBold('G'.$rowpointer);
$this->PhpExcel->setBold('J'.$rowpointer);
$this->PhpExcel->setRow(30);
$footer = 'Gegenereerd: '.date('Y-m-d H:i:s');
$this->PhpExcel->addDataRow(array('A'=> $footer, 'F'=>$footer));

$this->PhpExcel->output(); 
?>
