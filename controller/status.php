<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

include_once '../api/config/database.php';

$auth_key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
$base_url = "https://nextar.flip.id";
header('Content-Type: application/x-www-form-urlencoded');
header('Authorization: basic '  . $auth_key);

$id = $_GET['id'];

$request = file_get_contents($base_url . "/disburse/" . $id);
$data = json_decode($request);

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

//Update table: The information that must be updated when you check the disbursement status are the
// following: status,receipt and time_served
$db = new Database();
$conn = $db->getConnection();

//create db
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
}


?>
