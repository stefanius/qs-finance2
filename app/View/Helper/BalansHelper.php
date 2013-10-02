<?php
/**
 * Balans Helper.
 *
 * Methods to make numbers more readable.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Balans helper library.
 *
 * Helper for the Balans and its currency's.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @link http://book.cakephp.org/view/1452/Number
 */
class BalansHelper extends AppHelper
{
    public $helpers = array('Html', 'Number');
/**
 * Currencies supported by the helper.  You can add additional currency formats
 * with NumberHelper::addFormat
 *
 * @var array
 * @access protected
 */
    public $_currencies = array(
        'USD' => array(
            'before' => '$', 'after' => 'c', 'zero' => '-', 'places' => 2, 'thousands' => ',',
            'decimals' => '.', 'negative' => '-', 'escape' => true
        ),
        'GBP' => array(
            'before'=>'&#163;', 'after' => 'p', 'zero' => '-', 'places' => 2, 'thousands' => ',',
            'decimals' => '.', 'negative' => '-','escape' => false
        ),
        'EUR' => array(
            'before'=>'&#8364;', 'after' => false, 'zero' => '-', 'places' => 2, 'thousands' => '.',
            'decimals' => ',', 'negative' => '-', 'escape' => false
        )
    );

/**
 * Default options for currency formats
 *
 * @var array
 * @access protected
 */
    public $_currencyDefaults = array(
            'before'=>'', 'after' => '', 'zero' => 0, 'places' => 2, 'thousands' => '.',
            'decimals' => ',','negative' => '()', 'escape' => true
    );

    public $_currencyBalansDefaults = array(
            'before'=>'', 'after' => '', 'zero' => '-', 'places' => 2, 'thousands' => '.',
            'decimals' => ',','negative' => '-', 'escape' => true
    );

/**
 * Formats a number with a level of precision.
 *
 * @param float $number	A floating point number.
 * @param integer $precision The precision of the returned number.
 * @return float Formatted float.
 * @access public
 * @link http://book.cakephp.org/view/1454/precision
 */
    public function precision($number, $precision = 3)
    {
        return sprintf("%01.{$precision}f", $number);
    }

    /**
    * Retourneert een tabelrij voor een overzicht grootboekrekeningen
    *
    * @param grootboekrekening nr en balansarray: $grootboekpost
    * @return tabelrij grootboekoverzicht
    * @access public
    */
    public function toGrootboekOverzichtRij($grootboekpost, $bookyear_id)
    {
        $omschrijvingtxt = $grootboekpost['Grootboek']['nummer'].'-'.$grootboekpost['Grootboek']['omschrijving'];
        $url = 	$link = $this->Html->link($omschrijvingtxt, array('controller'=>'grootboeks', 'action' => 'open', $bookyear_id, $grootboekpost['Grootboek']['nummer'] ));
        //$omschrijving = '<a href="'.$url.'">'.$omschrijvingtxt.'</a>';
        $tablerow="";
        $tablerow = $tablerow. '<tr>';
        $tablerow = $tablerow. '<td class="omschrijving">'.$url.'</td>';
        $tablerow = $tablerow. '<td class="geld">'.$this->currency($grootboekpost['Bedrag']['debet'])."</td>";
        $tablerow = $tablerow. '<td class="geld">'.$this->currency($grootboekpost['Bedrag']['credit'])."</td>";
        $tablerow = $tablerow. '<td class="geld">'.$this->currency($grootboekpost['Bedrag']['saldo'])."</td>";
        $tablerow = $tablerow. '</tr>';

        return  $tablerow;

    }

    public function balansTitel($bookyear, $grootboek=null)
    {
        $titel="";
        $titel=$titel. '<div class="head">';
        if (isset($grootboek)) {
            $titel=$titel. '<h1>Grootboek: '.$grootboek['display_omschrijving'].'</h1>';
            $titel=$titel. '<h1>Per: '.$bookyear['balansdatum'] .'</h1>';
        } else {
            $titel=$titel. '<h1>Balans: '.$bookyear['omschrijving'].'</h1>';
            $titel=$titel. '<h1>Per: '.$bookyear['balansdatum'] .'</h1>';
        }
        $titel=$titel. '</div>';

        return $titel;
    }

    /**
    * Retourneert een tabelrij voor een eenvoudige Balans
    *
    * @param $grootboek, $grootboekpost
    * @return $rij Saldo en URL naar grootboek
    * @access public
    */
    public function balansRij($grootboek, $bookyear_id)
    {
        $a = $grootboek;
        if ($a['Grootboek']['nummer']>0) {
            $caption = '('.$a['Grootboek']['nummer'].') '.$a['Grootboek']['omschrijving'];
        } else {
            $caption =$a['Grootboek']['omschrijving'];
        }
        $link = $this->Html->link($caption, array('controller'=>'grootboeks', 'action' => 'open', $bookyear_id, $a['Grootboek']['nummer'] ));
        $rij = "";
        $rij = $rij."<tr>";
        $rij = $rij.'<td>'.$link.'</td>';
        $rij = $rij.'<td class="geld">'.$this->currency($a['Bedrag']['saldo'])."</td>";
        $rij = $rij."</tr>";

        return $rij;
    }

    public function openGrootboekRij($grootboek_rij)
    {
        if (isset( $grootboek_rij['id'])) {
            $link = $this->Html->link($grootboek_rij['omschrijving'], array('controller'=>'calculations', 'action' => 'view', $grootboek_rij['id'] ));
        } else {
            $link = $grootboek_rij['omschrijving'];
        }

        $rij="";
        $rij=$rij. "<tr>";
        if (isset($grootboek_rij['boekdatum'])) {
            $rij=$rij. '<td class="datum">'.$grootboek_rij['boekdatum']."</td>";
        } else {
            $rij=$rij. '<td class="datum">'." </td>";
        }

        $rij=$rij. '<td class="omschrijving">'.$link.'</td>';
        $rij=$rij. '<td class="geld">'.$this->currency($grootboek_rij['debet'])."</td>";
        $rij=$rij. '<td class="geld">'.$this->currency($grootboek_rij['credit'])."</td>";
        $rij=$rij. "</tr>";

        return $rij;
    }


/**
 * Retourneert een tabelrij voor een kolombalans
 *
 * @param grootboekrekening nr en balansarray: $grootboek. $balans
 * @return tabelrij kolombalans
 * @access public
 */
    public function toKolomBalansRij($gb_arr, $balans)
    {
        $grootboek = $gb_arr['nummer'];
        $tablerow="";
        $tablerow= $tablerow."<tr>";
        $tablerow= $tablerow.'<td>'.$grootboek.'</td>';
        $tablerow= $tablerow.'<td>'.$gb_arr['omschrijving'].'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['beginbalans'][$grootboek]['debet'],'').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['beginbalans'][$grootboek]['credit'],'').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['proefbalans'][$grootboek]['debet'],'').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['proefbalans'][$grootboek]['credit'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['saldibalans'][$grootboek]['debet'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['saldibalans'][$grootboek]['credit'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['winstverlies'][$grootboek]['debet'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['winstverlies'][$grootboek]['credit'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['eindbalans'][$grootboek]['debet'], ' ').'</td>';
        $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['eindbalans'][$grootboek]['credit'], ' ').'</td>';
        $tablerow= $tablerow."</tr>";

        return  $tablerow;
    }

    public function toKolomBalansRij2($gb_arr, $balans)
    {
        $grootboek = $gb_arr['nummer'];
        $balanszijde =  $gb_arr['debetcredit'];
        $tablerow="";
        $tablerow= $tablerow."<tr>";
        $tablerow= $tablerow.'<td>'.$grootboek.'</td>';
        $tablerow= $tablerow.'<td>'.$gb_arr['omschrijving'].'</td>';

        if (array_key_exists($grootboek, $balans['beginbalans'][$balanszijde]['posten'])) {
            if ($balanszijde=='debet') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency($balans['beginbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency(0,'').'</td>';
            } elseif ($balanszijde=='credit') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['beginbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
            }
        } else {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency(0,'').'</td>';
        }

        if (array_key_exists($grootboek, $balans['proefbalans'][$balanszijde]['posten'])) {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency($balans['proefbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['debet'],'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['proefbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['credit'],'').'</td>';
        } else {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(999990,'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency(999990,'').'</td>';
        }

        if (array_key_exists($grootboek, $balans['saldibalans'][$balanszijde]['posten'])) {
            if ($balanszijde=='debet') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency($balans['saldibalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency(0,'').'</td>';
            } elseif ($balanszijde=='credit') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['saldibalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
            }
        } else {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency(0, ' ').'</td>';
        }

        if (array_key_exists($grootboek, $balans['winstverlies'][$balanszijde]['posten'])) {
            if ($balanszijde=='debet') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency($balans['winstverlies'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency(0,'').'</td>';
            } elseif ($balanszijde=='credit') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['winstverlies'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
            }
        } else {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency(0, ' ').'</td>';
        }

        if (array_key_exists($grootboek, $balans['eindbalans'][$balanszijde]['posten'])) {
            if ($balanszijde=='debet') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency($balans['eindbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency(0,'').'</td>';
            } elseif ($balanszijde=='credit') {
                $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
                $tablerow= $tablerow.'<td class="geld">'.$this->currency($balans['eindbalans'][$balanszijde]['posten'][$grootboek]['Bedrag']['saldo'],'').'</td>';
            }
        } else {
            $tablerow= $tablerow.'<td class="geld debet">'.$this->currency(0,'').'</td>';
            $tablerow= $tablerow.'<td class="geld">'.$this->currency(0, ' ').'</td>';
        }

        $tablerow= $tablerow."</tr>";

        return  $tablerow;
    }

/**
 * Returns a formatted-for-humans file size.
 *
 * @param integer $length Size in bytes
 * @return string Human readable size
 * @access public
 * @link http://book.cakephp.org/view/1456/toReadableSize
 */
    public function toReadableSize($size)
    {
            switch (true) {
                case $size < 1024:
                        return sprintf(__n('%d Byte', '%d Bytes', $size), $size);
                case round($size / 1024) < 1024:
                        return sprintf(__('%d KB'), $this->precision($size / 1024, 0));
                case round($size / 1024 / 1024, 2) < 1024:
                        return sprintf(__('%.2f MB'), $this->precision($size / 1024 / 1024, 2));
                case round($size / 1024 / 1024 / 1024, 2) < 1024:
                        return sprintf(__('%.2f GB'), $this->precision($size / 1024 / 1024 / 1024, 2));
                default:
                        return sprintf(__('%.2f TB'), $this->precision($size / 1024 / 1024 / 1024 / 1024, 2));
            }
    }

/**
 * Formats a number into a percentage string.
 *
 * @param float $number A floating point number
 * @param integer $precision The precision of the returned number
 * @return string Percentage string
 * @access public
 * @link http://book.cakephp.org/view/1455/toPercentage
 */
    public function toPercentage($number, $precision = 2)
    {
        return $this->precision($number, $precision) . '%';
    }

/**
 * Formats a number into a currency format.
 *
 * @param float $number A floating point number
 * @param integer $options if int then places, if string then before, if (,.-) then use it
 *   or array with places and before keys
 * @return string formatted number
 * @access public
 * @link http://book.cakephp.org/view/1457/format
 */
    public function format($number, $options = false)
    {
        $places = 0;
        if (is_int($options)) {
            $places = $options;
        }

        $separators = array(',', '.', '-', ':');

        $before = $after = null;
        if (is_string($options) && !in_array($options, $separators)) {
            $before = $options;
        }
        $thousands = ',';
        if (!is_array($options) && in_array($options, $separators)) {
            $thousands = $options;
        }
        $decimals = '.';
        if (!is_array($options) && in_array($options, $separators)) {
            $decimals = $options;
        }

        $escape = true;
        if (is_array($options)) {
            $options = array_merge(array('before'=>'$', 'places' => 2, 'thousands' => ',', 'decimals' => '.'), $options);
            extract($options);
        }

        $out = $before . number_format($number, $places, $decimals, $thousands) . $after;

        if ($escape) {
            return h($out);
        }

        return $out;
    }

/**
 * Formats a number into a currency format.
 *
 * ### Options
 *
 * - `before` - The currency symbol to place before whole numbers ie. '$'
 * - `after` - The currency symbol to place after decimal numbers ie. 'c'. Set to boolean false to
 *    use no decimal symbol.  eg. 0.35 => $0.35.
 * - `zero` - The text to use for zero values, can be a string or a number. ie. 0, 'Free!'
 * - `places` - Number of decimal places to use. ie. 2
 * - `thousands` - Thousands separator ie. ','
 * - `decimals` - Decimal separator symbol ie. '.'
 * - `negative` - Symbol for negative numbers. If equal to '()', the number will be wrapped with ( and )
 * - `escape` - Should the output be htmlentity escaped? Defaults to true
 *
 * @param float $number
 * @param string $currency Shortcut to default options. Valid values are 'USD', 'EUR', 'GBP', otherwise
 *   set at least 'before' and 'after' options.
 * @param array $options
 * @return string Number formatted as a currency.
 * @access public
 * @link http://book.cakephp.org/view/1453/currency
 */
    public function currency($number, $currency = 'EUR', $options = array())
    {
          //  $a =  $this->Number->currency($number, $currency);
            //return $a;
        $default = $this->_currencyBalansDefaults;

        if (isset($this->_currencies[$currency])) {
            $default = $this->_currencies[$currency];
        } elseif (is_string($currency)) {
            $options['before'] = $currency;
        }

        $options = array_merge($default, $options);

        $result = null;

                //$number=floatval($number);
               // var_dump($number);
        if ($number == 0) {
            if ($options['zero'] !== 0) {
                return $options['zero'];
            }
            $options['after'] = null;
        } elseif ($number < 1 && $number > -1) {
            if ($options['after'] !== false) {
                $multiply = intval('1' . str_pad('', $options['places'], '0'));
                $number = $number * $multiply;
                $options['before'] = null;
                $options['places'] = null;
            }
        } elseif (empty($options['before'])) {
            $options['before'] = null;
        } else {
            $options['after'] = null;
        }

        $abs = abs($number);
        $result = $this->format($abs, $options);

        if ($number < 0) {
            if ($options['negative'] == '()') {
                $result = '(' . $result .')';
            } else {
                $result = $options['negative'] . $result;
            }
        }

        return $result;
    }

/**
 * Add a currency format to the Number helper.  Makes reusing
 * currency formats easier.
 *
 * {{{ $this->Number->addFormat('NOK', array('before' => 'Kr. ')); }}}
 *
 * You can now use `NOK` as a shortform when formatting currency amounts.
 *
 * {{{ $this->Number->currency($value, 'NOK'); }}}
 *
 * Added formats are merged with the following defaults.
 *
 * {{{
 *	array(
 *		'before' => '$', 'after' => 'c', 'zero' => 0, 'places' => 2, 'thousands' => ',',
 *		'decimals' => '.', 'negative' => '()', 'escape' => true
 *	)
 * }}}
 *
 * @param string $formatName The format name to be used in the future.
 * @param array $options The array of options for this format.
 * @return void
 * @see NumberHelper::currency()
 * @access public
 */
    public function addFormat($formatName, $options)
    {
        $this->_currencies[$formatName] = $options + $this->_currencyDefaults;
    }

}
