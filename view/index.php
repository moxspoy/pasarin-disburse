<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 12:36
 * Github       : https://github.com/moxspoy
 */

include 'header.php';
require_once '../model/database.php';

$db = new Database();
$db->settingUpDatabase();
$conn = $db->getConnection();

?>


<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="flex-center flex-column">
        <h1 class="animated fadeIn mb-2">Selamat Datang di Pasarin.id</h1>

        <h5 class="animated fadeIn mb-1">Online Marketplace Terbesar di Republik Indonesia</h5>

        <p class="animated fadeIn text-muted">Ini adalah halaman untuk pencairan uang anda</p>

        <a href="pencairan.php"> <button type="button" class="btn btn-primary">Klik disini untuk pencairan</button> </a>
        <a href="lihat_status.php"> <button type="button" class="btn btn-primary">Klik disini untuk lihat status pencairan</button> </a>


    </div>

</div>
<!-- /Start your project here-->
</body>

</html>

