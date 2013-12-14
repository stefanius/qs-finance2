<?php

App::uses('Component', 'ImportComponent');
class ImportRaboCsvComponent extends ImportComponent
{
    public function execute($filename = null, $source = null, $type = null)
    {
        $data = array();
        $sourceinfo = array();
        if (is_null($filename) || is_null($source) || is_null($type)) {
            throw new CakeException();
        }
            $this->Csv->setFirstLineAsHeader(false);
            $this->Csv->setUseHeaderAsKey(false);
            $csvdata =  $this->Csv->read($filename);

            foreach ($csvdata as $key=>$datarow) {
                $data[$key]['boekdatum'] = $datarow[7];
                $data[$key]['omschrijving'] = '';

                $data[$key]['omschrijving'] = $datarow[6] ;
                for ($i=10; $i<16;$i++) {
                    $data[$key]['omschrijving'] .= ' '. $datarow[$i] ;
                }
                $data[$key]['omschrijving'] = preg_replace('/\s+/', ' ', $data[$key]['omschrijving']) ;

                if (strlen($data[$key]['boekdatum']) == 8) {
                    $year = substr($data[$key]['boekdatum'], 0,4);
                    $month = substr($data[$key]['boekdatum'], 4,2);
                    $day = substr($data[$key]['boekdatum'], 6,2);
                    $data[$key]['boekdatum'] = $year.'-'.$month.'-'.$day;
                } else {
                    throw new CakeException('Boekdatum RABO incorrect.');
                }

                $sourceinfo['rekening'] = $datarow[0];
                // (D=af; C=bij - let op! Anders dan je zou verwachten!)
                if ($datarow[3] === 'D') {
                    $data[$key]['credit'] = $datarow[4] ;
                    $data[$key]['debet'] = 0;
                } else {
                    $data[$key]['debet'] =  $datarow[4] ;
                    $data[$key]['credit'] = 0;
                }
            }

        $rtrn = array();
        $rtrn['data']  = $data;
        $rtrn['sourceinfo']  = $sourceinfo;

        return $rtrn;
    }

/*

0 => REKENINGNUMMER_REKENINGHOUDER Alfanumeriek 35 Eigen Rekeningnummer in IBAN formaat
1 => MUNTSOORT Alfanumeriek 3 EUR
2 => RENTEDATUM Numeriek 8 Formaat: EEJJMMDD
3 => BY_AF_CODE Alfanumeriek 1 D of C (D=af; C=bij - let op! Anders dan je zou verwachten!)
4 => BEDRAG Numeriek 14 2 decimalen. Decimalen worden weergegeven met een punt
5 => TEGENREKENING Alfanumeriek 35 Tegenrekeningnummer
6 => NAAR_NAAM Alfanumeriek 70 Naam van de tegenrekeninghouder
7 => BOEKDATUM Numeriek 8 Formaat: EEJJMMDD
8 => BOEKCODE Alfanumeriek 2 Type transactie
9 => FILLER Alfanumeriek 6
10 => OMSCHR1 Alfanumeriek 35
11 => OMSCHR2 Alfanumeriek 35
12 => OMSCHR3 Alfanumeriek 35
13 => OMSCHR4 Alfanumeriek 35
14 => OMSCHR5 Alfanumeriek 35
15 => OMSCHR6 Alfanumeriek 35
16 => END_TO_END_ID Alfanumeriek 35 SEPA Credit Transfer: Kenmerk opgegeven door de opdrachtgever
17 => ID_TEGENREKENINGHOUDER Alfanumeriek 35 SEPA Credit Transfer: Identificatie van de tegenrekeninghouder
18 => MANDAAT_ID Alfanumeriek 35 SEPA Direct Debet: Kenmerk machtiging
 */
}
