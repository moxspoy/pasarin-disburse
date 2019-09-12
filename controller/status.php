<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

include_once '../api/config/database.php';

//header('Content-Type: application/x-www-form-urlencoded');
//header('Authorization: basic '  . $auth_key );

$id = $_GET['id'];

$request = file_get_contents($base_url . "/disburse/" . $id);
$data = json_decode($request);

$amount = $data->amount;
$status = $data->status;
$timestamp = $data->timestamp;
$bank_code = $data->bank_code;
$beneficiary_name = $data->beneficiary_name;
$remark = $data->remark;
$receipt = $data->receipt;
$time_served = $data->time_served;
$fee = $data->fee;

//Update table: The information that must be updated when you check the disbursement status are the
// following: status,receipt and time_served
$db = new Database();
$conn = $db->getConnection();

//


?>
