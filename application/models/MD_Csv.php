<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Csv extends CI_Model{
    public function removePercentage($value) {
        return str_replace('%', '', $value);
    }
    public function is_valid_date($date_str, $format = 'd/m/Y') {
        $d = DateTime::createFromFormat($format, $date_str);
        if ($d && $d->format($format) === $date_str) {
            return $d->format('Y-m-d'); 
        }
        return false;
    }
    public function is_positive($amount) {
        return $amount >= 0;
    }
    public function is_decimal($amount) {
        return is_float($amount) || is_numeric($amount) && strpos($amount, '.') !== false;
    }
}
?>