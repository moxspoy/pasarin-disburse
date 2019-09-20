<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

require_once '../config/database.php';
require_once '../config/constant.php';

/**Send Post Request to POST /disburse HTTP/1.1
 * Content-Type: application/x-www-form-urlencoded
 * Authorization: basic [your encoded slightly-big flip secret key]
*/

$url = BASE_URL . "/disburses";

//Check whether methos is post
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['bank_code'] = $_POST['bank_code'];
    $data['account_number'] = $_POST['account_number'];
    $data['amount'] = $_POST['amount'];
    $data['remark'] = $_POST['remark'];
    $result = createDisbursement("POST",$url,$data);
    saveToDatabase($result);
} else {
    $message['message'] = "bad request, please use post method";
    $result = json_encode($message);
    return $result;
}


function createDisbursement ($method, $url, $data) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURL_HTTP_VERSION_1_1, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: basic '. AUTH_KEY)
    );

    $content = "bank_code=" . $data['bank_code'] . "&amount=" . $data['amount']
        . "&account_number=" . $data['account_number'] . "&remark=" . $data['remark'];
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

/** Your service will then, save the detailed data about the disbursement from the 3rd party,
 * in your local database
 * @param $method
 * @param $url
 * @param bool $data
 * @return bool|string
 */

function saveToDatabase ($json_data) {
    $db = new Database();
    $conn = $db->getConnection();
    mysqli_select_db($conn, 'pasarin_disburse');

    $checkQuery = "SELECT 1 FROM 'disburse'  LIMIT 1";
    if(!$conn->query($checkQuery)) {
        $createTableQuery = 'CREATE TABLE disburse (
                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    id_from_api INT(12),
                    amount INT(30) NOT NULL,
                    status VARCHAR(30) NOT NULL,
                    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    bank_code VARCHAR(10) NOT NULL ,
                    account_number INT(15) NOT NULL,
                    beneficiary_name VARCHAR(50) NOT NULL,
                    remark VARCHAR(60) NOT NULL,
                    receipt VARCHAR (255) NOT NULL,
                    time_served TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    fee INT(100) NOT NULL
                    )';
        mysqli_query($conn, $createTableQuery);
    }

    $data = json_decode($json_data);
    $id_from_api = $data->id;
    $amount = $data->amount;
    $status = $data->status;
    $timestamp = $data->timestamp;
    $bank_code = $data->bank_code;
    $account_number = $data->account_number;
    $beneficiary_name = $data->beneficiary_name;
    $remark = $data->remark;
    $receipt = $data->receipt;
    $time_served = $data->time_served;
    $fee = $data->fee;


    $insertQuery = "INSERT INTO disburse (id_from_api, amount, status, timestamp, bank_code, account_number, 
                        beneficiary_name, remark, receipt, time_served, fee) 
                        VALUES ('$id_from_api','$amount', '$status', '$timestamp', '$bank_code', '$account_number',
                                '$beneficiary_name', '$remark', '$receipt', '$time_served', '$fee')";

    if(!$conn->query($insertQuery)) {
        echo "Error when inserting data to table because: " . mysqli_error($conn);
    } else {
        session_start();
        $_SESSION['id'] = $data->id;
        header('Location: ' . CLIENT_URL);
    }


}
?>
