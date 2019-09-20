<?php
/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 21 September 2019
 * Time         : 5:49
 * Github       : https://github.com/moxspoy
 */

class Validation
{
    public function isValidAccountNumber($number)
    {

        /** We need to validate account number. Here the assumtion:
         * - Empty number is not allowed
         * - Number of digit should between 2-15
         **/
        $n = strlen($number);
        if(empty($number)) {
            return false;
        }

        if($n < 2 || $n > 15) {
            return false;
        }

        return true;
    }

    public function isValidAmmount($amount) {
        /** We need to validate amount. Here the assumtion:
         * - Empty amount is not allowed
         * - Amount should between 200 - 10000000000
         **/
        $n = strlen($amount);
        if(empty($amount)) {
            return false;
        }

        if($n < 200 || $n > 10000000000) {
            return false;
        }

        return true;
    }
}