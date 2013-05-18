<?php
include_once 'phpexcel_setup.php';

class Download
{
	var $phpexcelCake;
	var $setup;
	var $objReader;
	var $objPHPExcel;
	
	public function __construct($objReader,$objPHPExcel){
		error_reporting(E_ALL);
		date_default_timezone_set('Europe/Amsterdam');
		$this->phpexcelCake = new PhpexcelCake();
		$this->setup = $this->phpexcelCake->get();
		require_once $this->setup['BASEDIR'].'phpexcel/Classes/PHPExcel/IOFactory.php';
		$this->objPHPExcel = $objPHPExcel;
		$this->objReader = $objReader;
	}

	public function download($filename='file'){
		$objPHPExcel = $this->objPHPExcel;
		//header("Content-Type: application/vnd.ms-excel; charset=utf-8");
                ob_end_clean();
		header("Content-Disposition: attachment; filename=\"".$filename.".xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save("php://output");		
	}	
}
?>