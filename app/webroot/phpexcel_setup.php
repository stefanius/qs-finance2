<?php

/*
 * Klasse gebruikt voor het koppelen van PHPExcel en CakePHP.
 *
 *
 *
 */
class PhpexcelCake
{
    public $setup;

    public function __construct()
    {
        $this->setup['BASEDIR'] = "../controllers/components/";
    }

    public function get()
    {
        return $this->setup;
    }

}
