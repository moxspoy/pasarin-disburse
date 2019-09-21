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
    $request = $db->getDataById($request_url);
    $data = json_decode($request);

    //Update table: The information that must be updated when you check the disbursement status are the
    //following: status,receipt and time_served
    if ($data != null) {
        $db->update($data, $id  );
    }  else {
        $message = "Gagal mendapatkan data dari server. Silahkan coba lagi";
        session_start();
        $_SESSION['error_server'] = $message;
        header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
    }

} else {
    $message = "Mohon gunakan method post, jangan mengakses langsung dari URL";
    session_start();
    $_SESSION['error_not_post'] = $message;
    header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
}


?>
