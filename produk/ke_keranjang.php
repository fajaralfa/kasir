<?php

require '../start.php';
require '../system/keranjang.php';

if (request_is('POST')) {
    $produk_id = $_POST['produk_id'];
    $nama = $_POST['nama'];
    $harga = (int) $_POST['harga'];
    $jumlah = (int) $_POST['jumlah'];

    keranjang_insert($produk_id, $nama, $harga, $jumlah);
    redirect('index.php');
}