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
if(isset($_SESSION['error']) && $_SESSION['error'] != null) {
    echo "<script>alert('Masukkan anda tidak valid. Nomor rekening yang dimasukkan terdiri dari 5 - 15 digit. ' +
            'Jumlah uang yang akan dicairkan berada di rentang Rp. 4000 - Rp. 10000000000')</script>";
    $_SESSION['error'] = null;
}

?>
<body>

<div class="container">
    <!-- Default form contact -->
    <form class="text-center border border-light p-5" action="../controller/disburse.php" method="post">

        <a href="<?php echo CLIENT_URL ?>"> <button class="btn btn-primary text-center">Home</button> </a>
        <p class="h4 mb-4">Lengkapi data untuk pencairan</p>

        <!-- Bank -->
        <label>Pilih Bank Anda</label>
        <select class="browser-default custom-select mb-4" name="bank_code" required>
            <option value="" disabled>Pilih Bank</option>
            <option value="bni" selected>BNI</option>
            <option value="btpn">Bank Mandiri</option>
            <option value="bca">BCA</option>
            <option value="bri">BRI</option>
            <option value="btpn">BTPN</option>
            <option value="btpn">Bank Permata</option>
        </select>

        <!-- No Rekening -->
        <input type="number" name="account_number" id="account_number" class="form-control mb-4"
               placeholder="Nomor rekening tujuan" required>

        <!-- Jumlah -->
        <input type="number" name="amount" id="amount" class="form-control mb-4"
               placeholder="Jumlah yang akan dicairkan" required>

        <!-- Remark -->
        <input type="text" name="remark" id="remark" class="form-control mb-4"
               placeholder="Remark" required>

        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit">Cairkan</button>

    </form>
    <!-- Default form contact -->
</div>

</body>

</html>

