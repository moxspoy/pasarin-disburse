<?php

/**
 * Created by   : MNurilmanBaehaqi
 * Date         : 12 September 2019
 * Time         : 12:36
 * Github       : https://github.com/moxspoy
 */

include 'header.php';
?>
<body>

<div class="container">
    <!-- Default form contact -->
    <form class="text-center border border-light p-5" action="../controller/status.php" method="get">

        <p class="h4 mb-4">Lihat status pencairan</p>


        <!-- No Transaksi -->
        <input type="number" name="id" class="form-control mb-4"
               placeholder="Masukan kode transaksi anda: " required>

        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit">Lihat Status</button>

    </form>
    <!-- Default form contact -->
</div>

</body>

</html>

