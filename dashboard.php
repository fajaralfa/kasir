<?php

require 'start.php';
$sql = "SELECT COUNT(*) as bulan_ini, SUM(total_harga) AS pendapatan_bulan_ini FROM penjualan WHERE
    MONTH(tanggal_penjualan) = MONTH(NOW()) AND YEAR(tanggal_penjualan) = YEAR(NOW())";
$penjualan = $db->query($sql)->fetch_assoc();

$sql = "SELECT COUNT(*) AS stok FROM produk";
$stok = $db->query($sql)->fetch_assoc()['stok'];


$sql = "SELECT SUM(total_harga) AS pendapatan_tahun_ini FROM penjualan WHERE
    YEAR(tanggal_penjualan) = YEAR(NOW())";
$pendapatan_tahun_ini = $db->query($sql)->fetch_assoc()['pendapatan_tahun_ini'];

?>

<?php
$title = 'Dashboard';
require 'layout/header.php';
?>

<div class="container py-5">
    <div class="row" style="width: 70rem;">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Penjualan Bulan Ini</h5>
            </div>
            <div class="card-body">
                <h1><?= $penjualan['bulan_ini'] ?></h1>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Pendapatan Bulan Ini</h5>
            </div>
            <div class="card-body">
                <h1><?= rp($penjualan['pendapatan_bulan_ini'] ?? 0) ?></h1>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Pendapatan Tahun Ini</h5>
            </div>
            <div class="card-body">
                <h1><?= rp($pendapatan_tahun_ini) ?></h1>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Stok Barang</h5>
            </div>
            <div class="card-body">
                <h1><?= $stok ?></h1>
            </div>
        </div>
    </div>
    </div>
</div>

<?php require 'layout/footer.php' ?>