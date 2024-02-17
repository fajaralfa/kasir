<?php

require '../start.php';

if(request_is('POST')) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', $harga, $stok)";
    $success = $db->query($sql);

    if ($success) {
        flash_messages(['Data produk telah disimpan!']);
        redirect('index.php');
    } else {
        flash_errors(['Data gagal disimpan!']);
        redirect('');
    }
}

?>

<?php
$title = 'Tambah Produk';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>