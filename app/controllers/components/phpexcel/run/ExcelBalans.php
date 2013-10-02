<?php
include_once 'phpexcel_setup.php';

class ExcelBalans
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
        $this->objPHPExcel = $this->objReader->load("../controllers/components/phpexcel/run/templates/balans.xls");
    }

    public function dorun($data)
    {
            $this->init();

        $objReader = $this->objReader;
        $objPHPExcel = $this->objPHPExcel;
        $i=1;
        $baseRow = 5;
        $total=0;
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Balans: '.$data['Bookyear']['omschrijving']);

        foreach ($data['debet']['posten'] as $r => $dataRow) {
            $row = $baseRow + $i;
            $total=$row;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $dataRow['Grootboek']['nummer']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $dataRow['Grootboek']['omschrijving']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $dataRow['Bedrag']['saldo']);
            $i++;
        }
        $total = $total +4;
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$total, 'TOTAAL');
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$total, $data['credit']['totaal']);
        $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

        $baseRow = 5;

        $i=0;
        $row = $baseRow + $i;
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, 'EV');
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, 'Eigen Vermogen');
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $data['ev']);
        $i++;

        foreach ($data['credit']['posten'] as $r => $dataRow) {
            $row = $baseRow + $i;
            $total=$row;
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $dataRow['Grootboek']['nummer']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $dataRow['Grootboek']['omschrijving']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $dataRow['Bedrag']['saldo']);
            $i++;
        }
        $total = $total+4;
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$total, 'TOTAAL');
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$total, $data['credit']['totaal']);
        $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

        $downloader = new Download($objReader, $objPHPExcel);
        $downloader->download('balans_'.$data['Bookyear']['omschrijving']);
    }
}
