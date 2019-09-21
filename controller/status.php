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
    $db->getDataById($_POST['id'], true);
} else {
    $message = "Mohon gunakan method post, jangan mengakses langsung dari URL";
    session_start();
    $_SESSION['error_not_post'] = $message;
    header('Location: ' . CLIENT_URL . "/view/lihat_status.php");
}



?>
