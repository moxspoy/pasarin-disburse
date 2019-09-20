<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

include_once '../model/database.php';
require_once '../config/constant.php';

$db = new Database();
$conn = $db->getConnection();



if(isset($_POST['id'])) {

    $id = $_POST['id'];
    $request_url = BASE_URL . "/disburse/" . $id;
    $request = getDataById($request_url);
    $data = json_decode($request);

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

    //Update table: The information that must be updated when you check the disbursement status are the
    // following: status,receipt and time_served
    mysqli_select_db($conn, DB_NAME);

    //create db
    $query = "SELECT * FROM disburse WHERE id_from_api=" . $id_from_api;
    $checkQuery = $conn->query($query);

    if($checkQuery->num_rows > 0) {
        //update db
        $updateQuery = "UPDATE disburse SET status='$status', receipt='$receipt',time_served='$time_served' WHERE id_from_api=" . $id;

        if(!$conn->query($updateQuery)) {
            echo "Error when updating data to table because: " . mysqli_error($conn);
        } else {

            //display page
            $singleData = $checkQuery->fetch_assoc();
            session_start();
            $_SESSION['success'] = $singleData;
            header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
        }

    } else{
        echo "No record found";
    }

} else {
    $message['message'] = "bad request, please use post method";
    $result = json_encode($message);
    return $result;
}


function getDataById ($url) {
    $key = AUTH_KEY;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURL_HTTP_VERSION_1_1, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded')
    );
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $key . ":" );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>
