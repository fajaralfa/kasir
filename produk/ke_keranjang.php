<?php

require '../start.php';
require '../system/keranjang.php';

if (request_is('POST')) {
    $produk_id = $_POST['produk_id'];
    $nama = $_POST['nama'];
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $jumlah = (int) $_POST['jumlah'];

    if ($stok >= $jumlah) {
        keranjang_insert($produk_id, $nama, $harga, $jumlah);
        flash_messages(['Produk berhasil ditambahkan ke keranjang!']);
    } else {
        flash_errors(['Jumlah yang dibeli melebihi stok!']);
    }

    redirect('index.php');
}