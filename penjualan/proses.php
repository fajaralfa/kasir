<?php

require '../start.php';
require '../system/keranjang.php';

// Buat data penjualan
$tanggal_penjualan = $_POST['tanggal_penjualan'];
$total_harga = $_POST['total'];

$db->begin_transaction();

$sql = "INSERT INTO penjualan (tanggal_penjualan, total_harga)
    VALUE ('$tanggal_penjualan', $total_harga)";
$db->query($sql);

$penjualan_id = $db->insert_id;

// Buat data detail penjualan
$data_keranjang = keranjang_all();
foreach ($data_keranjang as $produk_id => $produk) {
    $jumlah_produk = $produk['jumlah'];
    $subtotal = $produk['harga'] * $produk['jumlah'];

    $sql = "INSERT INTO detail_penjualan (penjualan_id, produk_id, jumlah_produk, subtotal)
    VALUES ($penjualan_id, $produk_id, $jumlah_produk, $subtotal)";
    $db->query($sql);
}

$db->commit();

keranjang_destroy();
flash_messages(['Penjualan Selesai!']);
redirect("detail.php?id=$penjualan_id");