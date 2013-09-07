<?php

$this->PhpExcel->createWorksheet(); 
$this->PhpExcel->setRow(1);
$this->PhpExcel->setActiveSheetIndex(0);

$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(4);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(5);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(34);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("G")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("H")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("I")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("J")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("K")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("L")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("M")->setWidth(8);
$this->PhpExcel->getExcel()->setActiveSheetIndex(0)->getColumnDimension("N")->setWidth(4);

$this->PhpExcel->getExcel()->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

$this->PhpExcel->getExcel()->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);	
$this->PhpExcel->getExcel()->getActiveSheet()->setShowGridlines(true);


$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A1:N100')->applyFromArray(
        array(  'fill' 	=> array(
                'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
                'color'	=> array('argb' => 'CCCCCC')),
                'borders' => array(
                'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

$FIRST_CALC_ROW=6;

$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->applyFromArray(array('font' => array('bold'  => true)));
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2))->applyFromArray(array('font' => array('bold'  => true)));

$this->PhpExcel->getExcel()->getActiveSheet()
                        ->setCellValue('B'.($FIRST_CALC_ROW-1),'#')
                        ->setCellValue('C'.($FIRST_CALC_ROW-1), 'omschrijving')
                        ->setCellValue('D'.($FIRST_CALC_ROW-1), 'debet')
                        ->setCellValue('E'.($FIRST_CALC_ROW-1), 'credit')
                        ->setCellValue('F'.($FIRST_CALC_ROW-1), 'debet')
                        ->setCellValue('G'.($FIRST_CALC_ROW-1), 'credit')
                        ->setCellValue('H'.($FIRST_CALC_ROW-1), 'debet')
                        ->setCellValue('I'.($FIRST_CALC_ROW-1), 'credit')
                        ->setCellValue('J'.($FIRST_CALC_ROW-1), 'debet')
                        ->setCellValue('K'.($FIRST_CALC_ROW-1), 'credit')
                        ->setCellValue('L'.($FIRST_CALC_ROW-1), 'debet')
                        ->setCellValue('M'.($FIRST_CALC_ROW-1), 'credit');

$this->PhpExcel->getExcel()->getActiveSheet()
                        ->setCellValue('D'.($FIRST_CALC_ROW-2), 'Beginbalans')
                        ->setCellValue('F'.($FIRST_CALC_ROW-2), 'Proefbalans')
                        ->setCellValue('H'.($FIRST_CALC_ROW-2), 'Saldibalans')
                        ->setCellValue('J'.($FIRST_CALC_ROW-2), 'W/V')
                        ->setCellValue('L'.($FIRST_CALC_ROW-2), 'Eindbalans');

$this->PhpExcel->getExcel()->getActiveSheet()
                        ->mergeCells('D'.($FIRST_CALC_ROW-2).':E'.($FIRST_CALC_ROW-2))	
                        ->mergeCells('F'.($FIRST_CALC_ROW-2).':G'.($FIRST_CALC_ROW-2))	
                        ->mergeCells('H'.($FIRST_CALC_ROW-2).':I'.($FIRST_CALC_ROW-2))	
                        ->mergeCells('J'.($FIRST_CALC_ROW-2).':K'.($FIRST_CALC_ROW-2))
                        ->mergeCells('L'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2));

$this->PhpExcel->getExcel()->getActiveSheet()
	->getStyle('D'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->PhpExcel->getExcel()->getActiveSheet()
	->getStyle('D'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$this->PhpExcel->getExcel()
        ->getActiveSheet()->getStyle('B'.$FIRST_CALC_ROW.':M'.$FIRST_CALC_ROW)
        ->applyFromArray(array('borders' => array('top'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

$rowNo=$FIRST_CALC_ROW;

$this->ExportKolomBalans->write_row($this->PhpExcel->getExcel(), 'ev', $rowNo, $data);
$rowNo++;               
foreach($data['posten']['balans'] as $rek){
    $this->ExportKolomBalans->write_row($this->PhpExcel->getExcel(), $rek, $rowNo, $data);
    $rowNo++;
}

foreach($data['posten']['resultaat'] as $rek){
    $this->ExportKolomBalans->write_row($this->PhpExcel->getExcel(), $rek, $rowNo, $data);
    $rowNo++;
}		
$this->PhpExcel->getExcel()->getActiveSheet()
    ->setCellValue('C'.$rowNo, 'TOTAAL')
    ->setCellValue('D'.$rowNo, '=SUM(D'.$FIRST_CALC_ROW.':D'.($rowNo-1).')')
    ->setCellValue('E'.$rowNo, '=SUM(E'.$FIRST_CALC_ROW.':E'.($rowNo-1).')')
    ->setCellValue('F'.$rowNo, '=SUM(F'.$FIRST_CALC_ROW.':F'.($rowNo-1).')')
    ->setCellValue('G'.$rowNo, '=SUM(G'.$FIRST_CALC_ROW.':G'.($rowNo-1).')')
    ->setCellValue('H'.$rowNo, '=SUM(H'.$FIRST_CALC_ROW.':H'.($rowNo-1).')')
    ->setCellValue('I'.$rowNo, '=SUM(I'.$FIRST_CALC_ROW.':I'.($rowNo-1).')')
    ->setCellValue('J'.$rowNo, '=SUM(J'.$FIRST_CALC_ROW.':J'.($rowNo-1).')')
    ->setCellValue('K'.$rowNo, '=SUM(K'.$FIRST_CALC_ROW.':K'.($rowNo-1).')')
    ->setCellValue('L'.$rowNo, '=SUM(L'.$FIRST_CALC_ROW.':L'.($rowNo-1).')')
    ->setCellValue('M'.$rowNo, '=SUM(M'.$FIRST_CALC_ROW.':M'.($rowNo-1).')');

$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A'.$rowNo.':N'.$rowNo)->getFont()->setSize(9);			
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('D'.$rowNo.':M'.$rowNo)->getNumberFormat()->setFormatCode('##,##0.00');			
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
        array('borders' => array('top'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

// Rename sheet
$this->PhpExcel->getExcel()->getActiveSheet()->setTitle('Kolombalans');		



/* ADD EXTRA SHEET */

$this->PhpExcel->getExcel()->createSheet(NULL, 1);
$this->PhpExcel->getExcel()->setActiveSheetIndex(1);
$this->PhpExcel->getExcel()->getActiveSheet()->setTitle('Liquide');	

$startRow=3;
$rowNo=$startRow;
foreach($liquideposten as $post){
    $this->PhpExcel->getExcel()->getActiveSheet()
        ->setCellValue('A'.$rowNo, $post['Grootboek']['nummer'])
        ->setCellValue('B'.$rowNo, $post['Grootboek']['omschrijving'])
        ->setCellValue('C'.$rowNo, $post['Bedrag']['debet'])
        ->setCellValue('D'.$rowNo, $post['Bedrag']['credit'])
        ->setCellValue('E'.$rowNo, $post['Bedrag']['saldo']);   
    $this->PhpExcel->getExcel()->getActiveSheet()->getStyle('C'.$rowNo.':E'.$rowNo)->getNumberFormat()->setFormatCode('_ * #,##0.00 ;_ * -#,##0.00 ;_ * ""??_ ;_ @_ ');
    $this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A'.$rowNo.':E'.$rowNo)->getFont()->setSize(9);					
    $this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A'.$rowNo.':E'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $this->PhpExcel->getExcel()->getActiveSheet()->getStyle('B'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $rowNo++;
}

$this->PhpExcel->getExcel()->getActiveSheet()
    ->setCellValue('A'.($startRow-1), '#')
    ->setCellValue('B'.($startRow-1), 'Omschrijving')
    ->setCellValue('C'.($startRow-1), 'Debet')
    ->setCellValue('D'.($startRow-1), 'Credit')
    ->setCellValue('E'.($startRow-1), 'Saldo');

$this->PhpExcel->getExcel()->getActiveSheet()
    ->setCellValue('A'.$rowNo, '')
    ->setCellValue('B'.$rowNo, 'Totaal')
    ->setCellValue('C'.$rowNo, '0')
    ->setCellValue('D'.$rowNo, '0')
    ->setCellValue('E'.$rowNo, '0');
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('C'.$rowNo.':E'.$rowNo)->getNumberFormat()->setFormatCode('_ * #,##0.00 ;_ * -#,##0.00 ;_ * ""??_ ;_ @_ ');
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A'.$rowNo.':E'.$rowNo)->getFont()->setSize(10);					
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('A'.$rowNo.':E'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$this->PhpExcel->getExcel()->getActiveSheet()->getStyle('B'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$this->PhpExcel->getExcel()->getActiveSheet()
    ->setCellValue('C'.$rowNo, '=SUM(C'.$startRow.':C'.($rowNo-1).')')
    ->setCellValue('D'.$rowNo, '=SUM(D'.$startRow.':D'.($rowNo-1).')')
    ->setCellValue('E'.$rowNo, '=SUM(E'.$startRow.':E'.($rowNo-1).')');


$this->PhpExcel->getExcel()->getActiveSheet()->getColumnDimension("A")->setWidth(5);
$this->PhpExcel->getExcel()->getActiveSheet()->getColumnDimension("B")->setWidth(35);
$this->PhpExcel->getExcel()->getActiveSheet()->getColumnDimension("C")->setWidth(11);
$this->PhpExcel->getExcel()->getActiveSheet()->getColumnDimension("D")->setWidth(11);
$this->PhpExcel->getExcel()->getActiveSheet()->getColumnDimension("E")->setWidth(11);

$timestamp = date('Y-m-d H:i:s');
$footer = 'Gegenereerd: '.$timestamp;
//$this->PhpExcel->addDataRow(array('A'=> $footer, 'F'=>$footer));
$this->PhpExcel->output('Kolombalans '.$data['Bookyear']['omschrijving'].' - '.$timestamp.'.xlsx');


 
