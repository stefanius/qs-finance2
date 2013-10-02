<?php
include_once 'phpexcel_setup.php';

class ExcelKolom
{
    public $phpexcelCake;
    public $setup;
    public $objReader;
    public $objPHPExcel;
    public $downloader;

    public function init()
    {
        //error_reporting(E_ALL);
        date_default_timezone_set('Europe/Amsterdam');
        $this->phpexcelCake = new PhpexcelCake();
        $this->setup = $this->phpexcelCake->get();
        require_once $this->setup['BASEDIR'].'phpexcel/run/download.php';
        require_once $this->setup['BASEDIR'].'phpexcel/Classes/PHPExcel/IOFactory.php';
        $this->objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->objPHPExcel = new PHPExcel();
    }

    public function dorun($data)
    {
        $this->init();
        $FIRST_CALC_ROW=6;
        $KOLOMBALANS_SHEET_INDEX=0;

        $objReader = $this->objReader;
        $objPHPExcel = $this->objPHPExcel;

        $objPHPExcel->getProperties()   ->setCreator("Maarten Balliauw")
                                                ->setLastModifiedBy("Maarten Balliauw")
                                                ->setTitle("Office 2007 XLSX Test Document")
                                                ->setSubject("Office 2007 XLSX Test Document")
                                                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                                ->setKeywords("office 2007 openxml php")
                                                ->setCategory("Test result file");
        //Format basics
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("A")->setWidth(4);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("B")->setWidth(5);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("C")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("D")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("E")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("F")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("G")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("H")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("I")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("J")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("K")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("L")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("M")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("N")->setWidth(4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getActiveSheet()->setShowGridlines(true);

        $objPHPExcel->getActiveSheet()->getStyle('A1:N100')->applyFromArray(
            array(  'fill' 	=> array(
                                'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
                                'color'	=> array('argb' => 'CCCCCC')),
                'borders' => array(
                                'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

        // Add some data
        $objPHPExcel->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->applyFromArray(array('font'    => array('bold'      => true)));
        $objPHPExcel->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-1))->applyFromArray(array('font'    => array('bold'      => true)));

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
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

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->setCellValue('D'.($FIRST_CALC_ROW-2), 'Beginbalans')
                    ->setCellValue('F'.($FIRST_CALC_ROW-2), 'Proefbalans')
                    ->setCellValue('H'.($FIRST_CALC_ROW-2), 'Saldibalans')
                    ->setCellValue('J'.($FIRST_CALC_ROW-2), 'W/V')
                    ->setCellValue('L'.($FIRST_CALC_ROW-2), 'Eindbalans');

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->mergeCells('D'.($FIRST_CALC_ROW-2).':E'.($FIRST_CALC_ROW-2))
                    ->mergeCells('F'.($FIRST_CALC_ROW-2).':G'.($FIRST_CALC_ROW-2))
                    ->mergeCells('H'.($FIRST_CALC_ROW-2).':I'.($FIRST_CALC_ROW-2))
                    ->mergeCells('J'.($FIRST_CALC_ROW-2).':K'.($FIRST_CALC_ROW-2))
                    ->mergeCells('L'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2));

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->getStyle('D'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->getStyle('D'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('B'.$FIRST_CALC_ROW.':M'.$FIRST_CALC_ROW)->applyFromArray(
            array('borders' => array(
                                        'top'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );

        $rowNo=$FIRST_CALC_ROW;

                $this->write_row($objPHPExcel, 'ev', $rowNo, $data);
                $rowNo++;
        foreach ($data['posten']['balans'] as $rek) {
            $this->write_row($objPHPExcel, $rek, $rowNo, $data);
            $rowNo++;
        }

        foreach ($data['posten']['resultaat'] as $rek) {
            $this->write_row($objPHPExcel, $rek, $rowNo, $data);
                        $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNo.':M'.$rowNo)->getNumberFormat()->setFormatCode('##,##0.00');
            $rowNo++;
        }
        //Tel alles bij elkaar op

        $objPHPExcel->setActiveSheetIndex(0)
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

        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNo.':N'.$rowNo)->getFont()->setSize(9);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNo.':M'.$rowNo)->getNumberFormat()->setFormatCode('##,##0.00');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('borders' => array('top'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Kolombalans');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $downloader = new Download($objReader, $objPHPExcel);
        $downloader->download('aap');
    }

    public function write_row($objPHPExcel, $rek, $rowNo, $data)
    {
           // var_dump($data['beginbalans'][$zijde]['posten'][$reknr]['Bedrag']);
            //exit;
            if ($rek==='ev') {
         $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$rowNo, '#')
                    ->setCellValue('C'.$rowNo, 'Eigen Vermogen')
                    ->setCellValue('E'.$rowNo, $data['beginbalans']['ev'])
                    ->setCellValue('G'.$rowNo, $data['proefbalans']['ev'])
                    ->setCellValue('I'.$rowNo, $data['saldibalans']['ev'])
                     ->setCellValue('K'.$rowNo, $data['winstverlies']['ev'])
                    ->setCellValue('M'.$rowNo, $data['eindbalans']['ev']);
            } else {
                $zijde=$rek['Grootboek']['debetcredit'];
                $reknr = $rek['Grootboek']['nummer'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$rowNo, '#'.$rek['Grootboek']['nummer']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$rowNo, $rek['Grootboek']['omschrijving']);

                if (array_key_exists($reknr, $data['beginbalans'][$zijde]['posten'])) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$rowNo, $data['beginbalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$rowNo, $data['beginbalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
                }
                if (array_key_exists($reknr, $data['proefbalans'][$zijde]['posten'])) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$rowNo, $data['proefbalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$rowNo, $data['proefbalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
                }
                if (array_key_exists($reknr, $data['saldibalans'][$zijde]['posten'])) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$rowNo, $data['saldibalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$rowNo, $data['saldibalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
                }
                if (array_key_exists($reknr, $data['winstverlies'][$zijde]['posten'])) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$rowNo, $data['winstverlies'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$rowNo, $data['winstverlies'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
                }
                if (array_key_exists($reknr, $data['eindbalans'][$zijde]['posten'])) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$rowNo, $data['eindbalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$rowNo, $data['eindbalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
                }
            }

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNo.':M'.$rowNo)->getNumberFormat()->setFormatCode('##,##0.00');

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNo.':N'.$rowNo)->getFont()->setSize(8);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNo.':M'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('fill' 	=> array(
                                        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                                        'color'		=> array('argb' => 'FFFFFF')
                                    )
                  )
        );

        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':C'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNo.':E'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );

        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNo.':G'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowNo.':I'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNo.':K'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
    }
}
?>

<?php

/*
include_once 'phpexcel_setup.php';

class ExcelKolomOld
{
    public $phpexcelCake;
    public $setup;
    public $objReader;
    public $objPHPExcel;
    public $downloader;

    public function init()
    {
        error_reporting(E_ALL);
        date_default_timezone_set('Europe/Amsterdam');
        $this->phpexcelCake = new PhpexcelCake();
        $this->setup = $this->phpexcelCake->get();
        require_once $this->setup['BASEDIR'].'phpexcel/run/download.php';
        require_once $this->setup['BASEDIR'].'phpexcel/Classes/PHPExcel/IOFactory.php';
        $this->objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->objPHPExcel = new PHPExcel();
    }

    public function dorun($data)
    {
        $this->init();
        $FIRST_CALC_ROW=6;
        $KOLOMBALANS_SHEET_INDEX=0;

        $objReader = $this->objReader;
        $objPHPExcel = $this->objPHPExcel;

        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");
        //Format basics
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("A")->setWidth(4);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("B")->setWidth(5);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("C")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("D")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("E")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("F")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("G")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("H")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("I")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("J")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("K")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("L")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("M")->setWidth(8);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)->getColumnDimension("N")->setWidth(4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getActiveSheet()->setShowGridlines(true);

        $objPHPExcel->getActiveSheet()->getStyle('A1:N100')->applyFromArray(
            array('fill' 	=> array(
                                        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                                        'color'		=> array('argb' => 'CCCCCC')
                                    ),
                  'borders' => array(
                                        'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );

        // Add some data
        $objPHPExcel->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->applyFromArray(array('font'    => array('bold'      => true)));
        $objPHPExcel->getActiveSheet()->getStyle('B'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-1))->applyFromArray(array('font'    => array('bold'      => true)));

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
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

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->setCellValue('D'.($FIRST_CALC_ROW-2), 'Beginbalans')
                    ->setCellValue('F'.($FIRST_CALC_ROW-2), 'Proefbalans')
                    ->setCellValue('H'.($FIRST_CALC_ROW-2), 'Saldibalans')
                    ->setCellValue('J'.($FIRST_CALC_ROW-2), 'W/V')
                    ->setCellValue('L'.($FIRST_CALC_ROW-2), 'Eindbalans');

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->mergeCells('D'.($FIRST_CALC_ROW-2).':E'.($FIRST_CALC_ROW-2))
                    ->mergeCells('F'.($FIRST_CALC_ROW-2).':G'.($FIRST_CALC_ROW-2))
                    ->mergeCells('H'.($FIRST_CALC_ROW-2).':I'.($FIRST_CALC_ROW-2))
                    ->mergeCells('J'.($FIRST_CALC_ROW-2).':K'.($FIRST_CALC_ROW-2))
                    ->mergeCells('L'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2));

        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->getStyle('D'.($FIRST_CALC_ROW-2).':M'.($FIRST_CALC_ROW-2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex($KOLOMBALANS_SHEET_INDEX)
                    ->getStyle('D'.($FIRST_CALC_ROW-1).':M'.($FIRST_CALC_ROW-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('B'.$FIRST_CALC_ROW.':M'.$FIRST_CALC_ROW)->applyFromArray(
            array('borders' => array(
                                        'top'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );

        $rowNo=$FIRST_CALC_ROW;
        foreach ($data['posten']['balans'] as $rek) {
            $this->write_row($objPHPExcel, $rek, $rowNo, $data);
            $rowNo++;
        }

        foreach ($data['posten']['resultaat'] as $rek) {
            $this->write_row($objPHPExcel, $rek, $rowNo, $data);
            $rowNo++;
        }
        //Tel alles bij elkaar op

        $objPHPExcel->setActiveSheetIndex(0)
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

        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'top'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Kolombalans');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $downloader = new Download($objReader, $objPHPExcel);
        $downloader->download();
    }

    public function write_row($objPHPExcel, $rek, $rowNo, $data)
    {
         $reknr = $rek['Grootboek']['nummer'];
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$rowNo, '#'.$rek['Grootboek']['nummer'])
                    ->setCellValue('C'.$rowNo, $rek['Grootboek']['omschrijving'])
                    ->setCellValue('D'.$rowNo, $data['beginbalans'][$reknr]['debet'])
                    ->setCellValue('E'.$rowNo, $data['beginbalans'][$reknr]['credit'])
                    ->setCellValue('F'.$rowNo, $data['proefbalans'][$reknr]['debet'])
                    ->setCellValue('G'.$rowNo, $data['proefbalans'][$reknr]['credit'])
                    ->setCellValue('H'.$rowNo, $data['saldibalans'][$reknr]['debet'])
                    ->setCellValue('I'.$rowNo, $data['saldibalans'][$reknr]['credit'])
                    ->setCellValue('J'.$rowNo, $data['winstverlies'][$reknr]['debet'])
                    ->setCellValue('K'.$rowNo, $data['winstverlies'][$reknr]['credit'])
                    ->setCellValue('L'.$rowNo, $data['eindbalans'][$reknr]['debet'])
                    ->setCellValue('M'.$rowNo, $data['eindbalans'][$reknr]['credit']);

        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNo.':N'.$rowNo)->getFont()->setSize(8);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNo.':M'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('fill' 	=> array(
                                        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                                        'color'		=> array('argb' => 'FFFFFF')
                                    )
                  )
        );

        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNo.':C'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNo.':E'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );

        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNo.':G'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowNo.':I'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNo.':K'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNo.':M'.$rowNo)->applyFromArray(
            array('borders' => array(
                                        'left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                        'inside'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                    )
                 )
            );
    }
}*/
