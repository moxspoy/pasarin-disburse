<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 12:36
 * Github       : https://github.com/moxspoy
 */

include 'header.php';

session_start();
if(isset($_SESSION['id'])) {
    echo "<script>alert('Sukses membuat disbursement. Anda bisa mengecek status dengan id = " . $_SESSION['id'] ."')</script>";
}
session_destroy();
?>
<body>

<div class="container">
    <!-- Default form contact -->
    <form class="text-center border border-light p-5" action="../controller/status.php" method="post">

        <p class="h4 mb-4">Lihat status pencairan</p>


        <!-- No Transaksi -->
        <input type="number" name="id" class="form-control mb-4"
               placeholder="Masukan kode transaksi anda: " required>

        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit">Lihat Status</button>

    </form>
    <!-- Default form contact -->
    <?php
    if(isset($_SESSION['success'])) {
        $data = $_SESSION['success'];
        echo "
        <div class=\"table-responsive\">
  <table class=\"table\">
    <thead>
      <tr>
        <th scope=\"col\">ID</th>
        <th scope=\"col\">Nomor Rekening</th>
        <th scope=\"col\">Jumlah</th>
        <th scope=\"col\">Status</th>
        <th scope=\"col\">Receipt</th>
        <th scope=\"col\">Waktu</th>
        <th scope=\"col\">Biaya</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope=\"row\">" . $data['id_from_api'] . "</th>
        <td>" . $data['id_from_api'] . "</td>
        <td>" . $data['account_number'] . "</td>
        <td>" . $data['amount'] . "</td>
        <td>" . $data['status'] . "</td>
        <td>" . $data['receipt'] . "</td>
        <td>" . $data['timestamp'] . "</td>
        <td>" . $data['fee'] . "</td>
      </tr>
    </tbody>
  </table>
</div>
        ";
        session_destroy();
    } else {
        echo "No record found";
    }
    ?>
</div>

</body>

</html>

d