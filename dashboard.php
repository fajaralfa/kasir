<?php

require 'start.php';
$sql = "SELECT COUNT(*) as bulan_ini, SUM(total_harga) AS pendapatan_bulan_ini FROM penjualan WHERE
    MONTH(tanggal_penjualan) = MONTH(NOW()) AND YEAR(tanggal_penjualan) = YEAR(NOW())";
$penjualan = $db->query($sql)->fetch_assoc();

?>

<?php
$title = 'Dashboard';
require 'layout/header.php';
?>

<div class="container py-5">
    <div class="row" style="width: 50rem;">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Penjualan Bulan Ini</h3>
            </div>
            <div class="card-body">
                <h1><?= $penjualan['bulan_ini'] ?></h1>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Pendapatan Bulan Ini</h3>
            </div>
            <div class="card-body">
                <h1><?= $penjualan['pendapatan_bulan_ini'] ?></h1>
            </div>
        </div>
    </div>
    </div>
</div>

<?php require 'layout/footer.php' ?>