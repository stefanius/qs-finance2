<?php

App::uses('Component', 'Controller');
class CsvComponent extends Component
{
    protected $firstLineAsHeader = false;
    protected $useHeaderAsKey = false;
    protected $headings = array();

    public function read($filename)
    {
        $csvdata = array();
        $csvheadings = array();
        $row = 0;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if ($row==0 && $this->firstLineAsHeader==true) {
                    for ($c=0; $c < $num; $c++) {
                        $csvheadings[$c] = $data[$c];
                    }
                } else {
                    if ($this->firstLineAsHeader===true && $this->useHeaderAsKey===true) {
                        for ($c=0; $c < $num; $c++) {
                            $csvdata[$row][$csvheadings[$c]] = $data[$c];
                        }
                    } else {
                        for ($c=0; $c < $num; $c++) {
                            $csvdata[$row][$c] = $data[$c];
                            $csvheadings[$c] = $c;
                        }
                    }
                }

                $row++;
            }
            fclose($handle);
        }
        $this->headings = $csvheadings;

        return $csvdata;
    }

    public function setFirstLineAsHeader($val)
    {
        $this->firstLineAsHeader = $val;
    }

    public function setUseHeaderAsKey($val)
    {
        $this->useHeaderAsKey = $val;
    }

    public function getHeadings()
    {
        return $this->headings;
    }
}
