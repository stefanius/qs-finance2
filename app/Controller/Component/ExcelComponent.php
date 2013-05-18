<?php
include('phpexcel/run/balans.php'); //Export naar Excel, eenvoudige balans
include('phpexcel/run/kolombalans.php'); //Export naar Excel, kolom balans
include('phpexcel/run/readkwartaal.php'); //importeer excelsheet (Speltak kwartaalafrekening)
class ExcelComponent extends Component {
	var $name = 'Excel';
    function exportbalans($data) {
        $export = new ExcelBalans();
	$export->dorun($data);
    }
	
    function exportkolombalans($data) {
        $export = new ExcelKolom();
	$export->dorun($data);
    }	
	
    function readkwartaal($data) {
        $import = new ReadKwartaal();
	$rtn = $import->dorun($data);
	return $rtn;
    }
}

?>