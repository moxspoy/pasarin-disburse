<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 13:23
 * Github       : https://github.com/moxspoy
 */

include_once '../api/config/database.php';
require_once '../api/config/constant.php';

$db = new Database();
$conn = $db->getConnection();


if(isset($_POST['id'])) {

    $id = $_POST['id'];
    $request_url = BASE_URL . "/disburse/" . $id;
    $request = file_get_contents($request_url);
    $data = json_decode($request);

    $id_from_api = $data->id_from_api;
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
    mysqli_select_db($conn, 'pasarin_disburse');

    //create db
    $query = "SELECT * FROM disburse WHERE id_from_api=" . $id;
    $checkQuery = $conn->query($query);

    if($checkQuery->num_rows > 0) {
        //update db
        $updateQuery = "UPDATE disburse SET status='$status', receipt='$receipt',time_served='$time_served' WHERE id_from_api=" . $id;

        if(!$conn->query($updateQuery)) {
            echo "Error when updating data to table because: " . mysqli_error($conn);
        } else {
            session_start();
            $_SESSION['id'] = $data->id;
            header('Location: ' . CLIENT_URL);
        }

        //display page

        $singleData = $checkQuery->fetch_assoc();
        session_start();
        $_SESSION['success'] = $singleData;
        header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
    } else{
        echo "No record found";
    }

} else {
    $message['message'] = "bad request, please use post method";
    $result = json_encode($message);
    return $result;
}

function checkStatusById ($method, $url, $data) {
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

?>
