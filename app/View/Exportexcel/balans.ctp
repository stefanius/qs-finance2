<?php

$this->PhpExcel->createWorksheet(); 
$this->PhpExcel->setDefaultFont('Calibri', 12); 

// define table cells 
$table = array( 
    array('label' => __('User'), 'width' => 'auto', 'filter' => true), 
    array('label' => __('Type'), 'width' => 'auto', 'filter' => true), 
    array('label' => __('Date'), 'width' => 'auto'), 
    array('label' => __('Description'), 'width' => 50, 'wrap' => true), 
    array('label' => __('Modified'), 'width' => 'auto') 
); 

// heading 
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true)); 

// data 
foreach ($data as $d) { 
    $this->PhpExcel->addTableRow(array( 
        $d['User']['name'], 
        $d['Type']['name'], 
        $d['User']['date'], 
        $d['User']['description'], 
        $d['User']['modified'] 
    )); 
} 

$this->PhpExcel->addTableFooter(); 
$this->PhpExcel->output(); 
?>
