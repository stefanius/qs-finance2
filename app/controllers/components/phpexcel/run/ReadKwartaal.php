<?php
include_once 'phpexcel_setup.php';
/*
Inlezen Kwartaal overzicht speltak.
*/
class ReadKwartaal
{
    public $phpexcelCake;
    public $setup;
    public $objReader;
    public $objPHPExcel;
    public $input; //De array die wordt geimporteerd in de database.
    public $sheetformat; //Formaat van de sheet, zoals eerst orderline, laatste orderline en kollommen.
    public $Grootboek;

    public function init($filename)
    {
        error_reporting(E_ALL);
        date_default_timezone_set('Europe/Amsterdam');
        $this->phpexcelCake = new PhpexcelCake();
        $this->setup = $this->phpexcelCake->get();
        require_once $this->setup['BASEDIR'].'phpexcel/Classes/PHPExcel/IOFactory.php';
        $this->objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->objPHPExcel = $this->objReader->load($filename);
        $this->Grootboek = ClassRegistry::init('Grootboek');
        //Setup sheetformat
        $this->sheetformat['FIRSTLINE']=8; //eersteregel
        $this->sheetformat['LASTLINE']=26; //laatste regel. LET OP! Het genoemde regelnummer wordt niet verwerkt. Als '25' de laatst te verwerken regel is, moet deze waarde '26' zijn.
        $this->sheetformat['COLLUMNDESCRIPTION']='A'; //De kolom waar de omschrijving staat
        $this->sheetformat['COLLUMNDATE']='D'; //De kolom waar de datum staat
        $this->sheetformat['COLLUMNCOUPON']='E'; //De kolom waar het bonnummer staat
        $this->sheetformat['COLLUMNSHOP']='F'; //De kolom waar de winkel staat
        $this->sheetformat['COLLUMNAMOUNT']='G'; //De kolom waar het bedrag staat

        //Sheet Instellingen
        $this->sheetformat['COLLUMNSETTINGS']='I'; //De kolom waar de instellingen staan
        $this->sheetformat['ROWSPELTAK']=7; //naam speltak
        $this->sheetformat['ROWKWARTAAL']=8; //Kwartaalnummer
        $this->sheetformat['ROWRESULTAAT']=9; //Speltak Resultaten rekening
        $this->sheetformat['ROWLEDEN']=10; //aantal betalende leden
        $this->sheetformat['ROWDATE']=11; //Laatste dag van het kwartaal
        $this->sheetformat['ROWBANK']=12; //Nummer van het grootboek bank van de betreffende speltak.

    }

    public function validate($line)
    {
        if (!isset($line['omschrijving'])) {
            return false;
        }

        //echo "a ";
        if (strlen($line['omschrijving']) < 3) {
            return false;
        }
        //echo "b ";
        if (!isset($line['bookyear_id'])) {
            return false;
        }
        //echo "c ";
        if (strlen($line['bookyear_id']) !=36) {
            return false;
        }
        //echo "d ";
        if (!isset($line['grootboek_id'])) {
            return false;
        }
        //echo "e ";
        if (strlen($line['grootboek_id']) != 36) {
            return false;
        }
        //echo "f ";
        if (!(isset($line['debet']) ^ isset($line['credit']))) {
            return false;
        }

        if (isset($line['debet'])) {
            if ($line['debet']==0) {
                return false;
            }
        }

        if (isset($line['credit'])) {
            if ($line['credit']==0) {
                return false;
        }
            }
        //echo "g ";
        return true;
    }

    public function dorun($data)
    {
        $this->init($data['filename']);
        $sf = $this->sheetformat;
        $c = $this->sheetformat['COLLUMNSETTINGS'];
        $boekdatum = '2011/12/30';

        $this->input['settings']['speltak'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWSPELTAK'])->getValue();
        $this->input['settings']['aantalleden'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWLEDEN'])->getValue();
        $this->input['settings']['resultaatpost'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWRESULTAAT'])->getValue();
        $this->input['settings']['bankpost'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWBANK'])->getValue();
        $this->input['settings']['datum'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWDATE'])->getValue();
        $this->input['settings']['kwartaal'] = $this->objPHPExcel->getActiveSheet()->getCell($c.$sf['ROWKWARTAAL'])->getValue();

        $gbBank = $this->Grootboek->get($this->input['settings']['bankpost']);
        $gbResultaat = $this->Grootboek->get($this->input['settings']['resultaatpost']);
        $index=0;
        for ($i=$sf['FIRSTLINE'];$i<$sf['LASTLINE'];$i++) {
            //Verminder bank
            $lines['Calculation'][$index]['omschrijving'] = 	$this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNDESCRIPTION'].$i)->getValue()."(datum:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNDATE'].$i)->getValue()."; bonnr:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNCOUPON'].$i)->getValue()."; winkel:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNSHOP'].$i)->getValue().")";
            $lines['Calculation'][$index]['credit'] = $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNAMOUNT'].$i)->getValue();
            $lines['Calculation'][$index]['boekdatum'] = $boekdatum;
            $lines['Calculation'][$index]['beginbalans'] = 0;
            $lines['Calculation'][$index]['boekingstuk'] = "KW-".$this->input['settings']['speltak']."-Q".$this->input['settings']['kwartaal'];
            $lines['Calculation'][$index]['grootboek_id'] = $gbBank['Grootboek']['id'];
            $lines['Calculation'][$index]['bookyear_id'] = $data['Bookyear']['id'];
            $index++;
            //Verhoog resultaatpost
            $lines['Calculation'][$index]['omschrijving'] = 	$this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNDESCRIPTION'].$i)->getValue()."(datum:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNDATE'].$i)->getValue()."; bonnr:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNCOUPON'].$i)->getValue()."; winkel:".
                                                                $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNSHOP'].$i)->getValue().")";
            $lines['Calculation'][$index]['debet'] = $this->objPHPExcel->getActiveSheet()->getCell($sf['COLLUMNAMOUNT'].$i)->getValue();
            $lines['Calculation'][$index]['boekdatum'] = $boekdatum;
            $lines['Calculation'][$index]['beginbalans'] = 0;
            $lines['Calculation'][$index]['boekingstuk'] = "KW-".$this->input['settings']['speltak']."-Q".$this->input['settings']['kwartaal'];
            $lines['Calculation'][$index]['grootboek_id'] = $gbResultaat['Grootboek']['id'];
            $lines['Calculation'][$index]['bookyear_id'] = $data['Bookyear']['id'];
            $index++;

        }

        $index=0;
        for ($i=0;$i<count($lines['Calculation']);$i++) {
            if ($this->validate($lines['Calculation'][$i])) {
                $this->input['Calculation'][$index] = $lines['Calculation'][$i];
                $index++;
            }
        }

        return $this->input;
    }

}
