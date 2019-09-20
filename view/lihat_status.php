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

session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] != null) {
    echo "<script>alert('Sukses membuat disbursement. Anda bisa mengecek status dengan id = " . $_SESSION['id'] ."')</script>";
    $_SESSION['id'] = null;
}

if(isset($_SESSION['error']) && $_SESSION['error'] != null) {
    echo "<script>alert('" . $_SESSION['error'] ."')</script>";
    $_SESSION['id'] = null;
}

?>
<body>

<div class="container">
    <a href="<?php echo CLIENT_URL ?>"> <button class="btn btn-primary text-center">Home</button> </a>
    <!-- Default form contact -->
    <form class="text-center border border-light p-5" action="../controller/status.php" method="post">


        <p class="h4 mb-4">Lihat status pencairan</p>


        <!-- No Transaksi -->
        <input type="number" name="id" class="form-control mb-4" id="id"
               placeholder="Masukan kode transaksi yang akan dicari: " required autofocus>

        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit">Lihat Status</button>

    </form>
    <!-- Default form contact -->

    <?php
    if(isset($_SESSION['success'])) {
        $data = $_SESSION['success'];
        if($data['receipt'] == null) {
            $data['receipt'] = "Struk belum tersedia";
        }

        echo "
        <div class=\"table-responsive\">
  
  <table class=\"table\">
    <thead>
      <tr>
        <th scope=\"col\">ID</th>
        <td>" . $data['id_from_api'] . "</td>
      </tr>
      <tr>
        <th scope=\"col\">Nomor Rekening</th>
        <td>" . $data['account_number'] . "</td>
       </tr>
       <tr>
        <th scope=\"col\">Kode Bank</th>
        <td>" . $data['bank_code'] . "</td>
      </tr>
      <tr>
        <th scope=\"col\">Jumlah</th>
        <td>" . $data['amount'] . "</td>
       </tr>
       <tr>
        <th scope=\"col\">Status</th>
        <td>" . $data['status'] . "</td>
      </tr>
      <tr>
        <th scope=\"col\">Nama Beneficiary</th>
        <td>" . $data['beneficiary_name'] . "</td>
       </tr>
       <tr>
        <th scope=\"col\">Remark</th>
        <td>" . $data['remark'] . "</td>
      </tr>
      <tr>
        <th scope=\"col\">Receipt</th>
        <td>" . $data['receipt'] . "</td>
       </tr>
       <tr>
        <th scope=\"col\">Waktu Pelayanan</th>
        <td>" . $data['time_served'] . "</td>
      </tr>
      <tr>
        <th scope=\"col\">Biaya</th>
        <td>" . $data['fee'] . "</td>
       </tr>
      
    </thead>
  
  </table>
</div>
        ";
        session_destroy();
    } else {
        echo "Masukkan ID pencairan anda di dalam kotak search di atas lalu klik Lihat Status";
    }
    ?>
</div>

</body>

</html>