<?php

require 'start.php';

// dibawah ini adalah kode untuk mengambil data dari database
// polanya adalah
// 1. buat teks query yang akan dijalankan dan simpan di variabel ($sql = 'SELECT COUNT()...')
// 2. jalankan perintah query diatas ($db->query($sql))
// 3. ambil data yang didapat (->fetch_assoc())
// 4. simpan di variabel ($penjualan, $produk, $pendapatan_tahun_ini)
// catatan, khusus untuk $pendapatan tahun ini, saya langsung mengambil data dari nama kolomnya
// (->fetch_assoc(['pendapatan_tahun_ini'])) karena kolom yang diambil hanya satu, jadi saya buat untuk mempersingkat kodingan

// perintah sql
$sql = "SELECT COUNT(*) as bulan_ini, SUM(total_harga) AS pendapatan_bulan_ini FROM penjualan WHERE
    MONTH(tanggal_penjualan) = MONTH(NOW()) AND YEAR(tanggal_penjualan) = YEAR(NOW())";

// kode untuk menjalankan perintah sql dan mengambil datanya
$penjualan = $db->query($sql)->fetch_assoc();

// polanya sama seperti diatas
$sql = "SELECT SUM(stok) AS stok, COUNT(*) AS jenis FROM produk";
$produk = $db->query($sql)->fetch_assoc();

$sql = "SELECT SUM(total_harga) AS pendapatan_tahun_ini FROM penjualan WHERE
    YEAR(tanggal_penjualan) = YEAR(NOW())";
$pendapatan_tahun_ini = $db->query($sql)->fetch_assoc()['pendapatan_tahun_ini'];

?>

<?php
$title = 'Dashboard';
require 'layout/header.php';
?>

<div class="container py-5" style="max-width: 70rem;">
    <div class="row mb-4">
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
                    <h5>Stok Produk</h5>
                </div>
                <div class="card-body">
                    <h1><?= $produk['stok'] ?? 0 ?></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5>Jenis Produk</h5>
                </div>
                <div class="card-body">
                    <h1><?= $produk['jenis'] ?? 0 ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
    </div>
</div>

<?php require 'layout/footer.php' ?>