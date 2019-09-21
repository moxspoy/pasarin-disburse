<?php
/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 21 September 2019
 * Time         : 5:49
 * Github       : https://github.com/moxspoy
 */
require_once 'Valid.php';

class Validation implements Valid
{
    public function isValidAccountNumber($number)
    {

        /** We need to validate account number. Here the assumtion:
         * - Empty number is not allowed
         * - Number of digit should between 5-15
         **/
        $n = strlen($number);
        if(empty($number)) {
            return false;
        }

        if($n < 5 || $n > 15) {
            return false;
        }

        return true;
    }

    public function isValidAmmount($amount) {
        /** We need to validate amount. Here the assumtion:
         * - Empty amount is not allowed
         * - Amount should between Rp. 4000 - Rp. 10000000000
         **/
        if(empty($amount)) {
            return false;
        }

        if($amount < 4000 || $amount > 10000000000) {
            return false;
        }

        return true;
    }

}