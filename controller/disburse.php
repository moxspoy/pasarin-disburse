<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

define('AUTH_KEY', 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41');
define('BASE_URL', 'https://nextar.flip.id');
$base_url = "https://nextar.flip.id";

$bank_code = $_POST['bank_code'];
$account_number = $_POST['account_number'];
$amount = $_POST['amount'];
$remark = $_POST['remark'];

/**Send Post Request to POST /disburse HTTP/1.1
 * Content-Type: application/x-www-form-urlencoded
 * Authorization: basic [your encoded slightly-big flip secret key]
*/
$data['bank_code'] = $bank_code;
$data['account_number'] = $account_number;
$data['amount'] = $amount;
$data['remark'] = $remark;

$url = BASE_URL . "/disburse";
$request = sendingRequest("POST",$url,$data);
echo $request;

/** Your service will then, save the detailed data about the disbursement from the 3rd party,
 * in your local database
 * @param $method
 * @param $url
 * @param bool $data
 * @return bool|string
 */

/*
$createTableQuery = "CREATE TABLE disburse (
                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    amount INT(30) NOT NULL,
                    status VARCHAR(30) NOT NULL,
                    timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    bank_code VARCHAR(10) NOT NULL ,
                    account_number INT(15) NOT NULL,
                    beneficiary_name VARCHAR(50) NOT NULL,
                    remark VARCHAR(60) NOT NULL,
                    receipt VARCHAR (255) NOT NULL,
                    time_served DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    fee INT(100) NOT NULL;
                    )";

$if(!$conn->query($createTableQuery)) {
    echo "Error when creating table";
} else {
    $insertQuery = "INSERT INTO disburse (amount, status, timestamp, bank_code, account_number, 
                    beneficiary_name, remark, receipt, time_served, fee) 
                    VALUES (" . $amount . ",". $status . ",". $timestamp . ",". $bank_code  . ",". $account_number
                    . ",". $beneficiary_name . ",". $remark . ",". $receipt . ",". $time_served . ",". $fee . ")";

    $if(!$conn->query($insertQuery)) {
        echo "Error when inserting data to table";
    } else {
        echo "Success creating and inserting to database"
    }
}*/

function sendingRequest ($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURL_HTTP_VERSION_1_1, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: basic '. AUTH_KEY)
            );

            if ($data)  {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>
