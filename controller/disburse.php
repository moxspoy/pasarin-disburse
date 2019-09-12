<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

$auth_key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
$base_url = "https://nextar.flip.id";

//header('Content-Type: application/x-www-form-urlencoded');
//header('Authorization: basic '  . $auth_key );

$bank_code = $_POST['bank_code'];
$account_number = $_POST['account_number'];
$amount = $_POST['amount'];
$remark = $_POST['remark'];

//echo $bank_code . " - " . $account_number . " - " . $amount . " - " . $remark;

?>
