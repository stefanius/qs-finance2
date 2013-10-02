<?php

//Database connection

$link = mysql_connect("localhost","deb32418_aap","grootjecms");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

mysql_select_db('deb32418_quaestor', $link);

$query = sprintf("SELECT *  FROM grootboeks WHERE debetcredit='debet'");
$result_gb_debet = mysql_query($query, $link);

$query = sprintf("SELECT *  FROM grootboeks WHERE debetcredit='credit'");
$result_gb_credit = mysql_query($query, $link);

$i=0;
while ($row = mysql_fetch_assoc($result_gb_debet)) {
    $debet[$i]['nummer'] = $row['nummer'];
    $debet[$i]['omschrijving'] = $row['omschrijving'];
    $debet[$i]['id'] = $row['id'];
    $i++;
}

$i=0;
while ($row = mysql_fetch_assoc($result_gb_credit)) {
    $credit[$i]['nummer'] = $row['nummer'];
    $credit[$i]['omschrijving'] = $row['omschrijving'];
    $credit[$i]['id'] = $row['id'];
    $i++;
}

/*
// Formulate Query
// This is the best way to perform an SQL query
// For more examples, see mysql_real_escape_string()
$bookyear = '4e382921-46c0-46e9-9271-17409d87f14d';
$query = sprintf("SELECT *  FROM calculations WHERE bookyear_id='%s' AND grootboek_id='%s'",
    mysql_real_escape_string($bookyear),
    mysql_real_escape_string($bookyear));

// Perform Query
$result = mysql_query($query, $link);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

// Use result
// Attempting to print $result won't allow access to information in the resource
// One of the mysql result functions must be used
// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
while ($row = mysql_fetch_assoc($result)) {
    print_r($row);
}

// Free the resources associated with the result set
// This is done automatically at the end of the script
mysql_free_result($result);




  */

  mysql_free_result($result_gb_debet);
  mysql_free_result($result_gb_credit);



  print_r($debet);

  print_r($credit);




/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';



echo date('H:i:s') . " Load from Excel5 template\n";
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("templates/balans.xls");




echo date('H:i:s') . " Add new data to the template\n";

//$objPHPExcel->getActiveSheet()->setCellValue('A3', PHPExcel_Shared_Date::PHPToExcel(time()));

$baseRow = 5;
foreach ($debet as $r => $dataRow) {
    $row = $baseRow + $r;
    //$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $dataRow['nummer']);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $dataRow['omschrijving']);
    //$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $dataRow['omschrijving']);
}
$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

$objPHPExcel->getActiveSheet()->setCellValue('B37', 'TOTAAL');

$baseRow = 5;
foreach ($credit as $r => $dataRow) {
    $row = $baseRow + $r;
    //$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);

    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $dataRow['nummer']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $dataRow['omschrijving']);
    //$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $dataRow['omschrijving']);
}


$objPHPExcel->getActiveSheet()->setCellValue('G37', 'TOTAAL');


echo date('H:i:s') . " Write to Excel5 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));




// Echo memory peak usage
echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
echo date('H:i:s') . " Done writing file.\r\n";
