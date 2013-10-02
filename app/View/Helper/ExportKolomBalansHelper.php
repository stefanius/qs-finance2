<?php
App::uses('PhpExcelHelper', 'View/Helper');

/**
 * Helper for working with PHPExcel class.
 * PHPExcel has to be in the vendors directory.
 */

class ExportKolomBalansHelper extends AppHelper
{
    public function write_row($Excel, $rek, $rowNo, $data)
    {
        if ($rek==='ev') {
            $Excel->getActiveSheet()
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
            $Excel->getActiveSheet()->setCellValue('B'.$rowNo, '#'.$rek['Grootboek']['nummer']);
            $Excel->getActiveSheet()->setCellValue('C'.$rowNo, $rek['Grootboek']['omschrijving']);

            if (array_key_exists($reknr, $data['beginbalans'][$zijde]['posten'])) {
                $Excel->getActiveSheet()->setCellValue('D'.$rowNo, $data['beginbalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                $Excel->getActiveSheet()->setCellValue('E'.$rowNo, $data['beginbalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
            }
            if (array_key_exists($reknr, $data['proefbalans'][$zijde]['posten'])) {
                $Excel->getActiveSheet()->setCellValue('F'.$rowNo, $data['proefbalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                $Excel->getActiveSheet()->setCellValue('G'.$rowNo, $data['proefbalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
            }
            if (array_key_exists($reknr, $data['saldibalans'][$zijde]['posten'])) {
                $Excel->getActiveSheet()->setCellValue('H'.$rowNo, $data['saldibalans'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                $Excel->getActiveSheet()->setCellValue('I'.$rowNo, $data['saldibalans'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
            }
            if (array_key_exists($reknr, $data['winstverlies'][$zijde]['posten'])) {
                $Excel->getActiveSheet()->setCellValue('J'.$rowNo, $data['winstverlies'][$zijde]['posten'][$reknr]['Bedrag']['debet']);
                $Excel->getActiveSheet()->setCellValue('K'.$rowNo, $data['winstverlies'][$zijde]['posten'][$reknr]['Bedrag']['credit']);
            }
            if (array_key_exists($reknr, $data['eindbalans'][$zijde]['posten'])) {
                if ($zijde=='debet') {
                    $Excel->getActiveSheet()->setCellValue('L'.$rowNo, $data['eindbalans'][$zijde]['posten'][$reknr]['Bedrag']['saldo']);
                } else {
                    $Excel->getActiveSheet()->setCellValue('M'.$rowNo, $data['eindbalans'][$zijde]['posten'][$reknr]['Bedrag']['saldo']);
                }
            }
        }

        $Excel->getActiveSheet()->getStyle('D'.$rowNo.':M'.$rowNo)->getNumberFormat()->setFormatCode('_ * #,##0.00 ;_ * -#,##0.00 ;_ * ""??_ ;_ @_ ');

        $Excel->getActiveSheet()->getStyle('A'.$rowNo.':N'.$rowNo)->getFont()->setSize(8);
        $Excel->getActiveSheet()->getStyle('D'.$rowNo.':M'.$rowNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $Excel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
                    array('fill' => array( 'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                        'color' => array('argb' => 'FFFFFF'))));

        $Excel->getActiveSheet()->getStyle('B'.$rowNo.':C'.$rowNo)->applyFromArray(
                    array('borders' => array( 'left'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))));

        $Excel->getActiveSheet()->getStyle('D'.$rowNo.':E'.$rowNo)->applyFromArray(
                    array('borders' => array('left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'inside'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))) );

        $Excel->getActiveSheet()->getStyle('F'.$rowNo.':G'.$rowNo)->applyFromArray(
                    array('borders' => array('left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'inside'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))));

        $Excel->getActiveSheet()->getStyle('H'.$rowNo.':I'.$rowNo)->applyFromArray(
                    array('borders' => array('left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'inside'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))));

        $Excel->getActiveSheet()->getStyle('J'.$rowNo.':K'.$rowNo)->applyFromArray(
                    array('borders' => array('left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'inside'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))));

        $Excel->getActiveSheet()->getStyle('L'.$rowNo.':M'.$rowNo)->applyFromArray(
                    array('borders' => array('left'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'right'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                                            'inside'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))));
        $Excel->getActiveSheet()->getStyle('B'.$rowNo.':M'.$rowNo)->applyFromArray(
                    array('borders' => array('bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN,
                                                              'color' => array('argb' => 'FFe4e4e4')))));
    }

}
