<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

require_once '../model/database.php';
require_once '../config/constant.php';

$db = new Database();

$url = BASE_URL . "/disburse";

//Check whether methos is post
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['bank_code'] = $_POST['bank_code'];
    $data['account_number'] = $_POST['account_number'];
    $data['amount'] = $_POST['amount'];
    $data['remark'] = $_POST['remark'];

    /**Send Post Request to POST /disburse HTTP/1.1
     * Content-Type: application/x-www-form-urlencoded
     * Authorization: basic [your encoded slightly-big flip secret key]
     */
    $result = createDisbursement("POST",$url,$data);


    /** Your service will then, save the detailed data about the disbursement from the 3rd party,
     * in your local database
     * @param $result
     */

    $db->insert($result);

} else {
    $message['message'] = "bad request, please use post method";
    $result = json_encode($message);
    return $result;
}


function createDisbursement ($method, $url, $data) {
    $key = AUTH_KEY;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURL_HTTP_VERSION_1_1, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded')
    );
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $key . ":" );

    $content = "bank_code=" . $data['bank_code'] . "&amount=" . $data['amount']
        . "&account_number=" . $data['account_number'] . "&remark=" . $data['remark'];
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

?>
