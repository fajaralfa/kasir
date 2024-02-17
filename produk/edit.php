<?php

require '../start.php';

$id = $_GET['id'];

if(request_is('POST')) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "UPDATE produk SET nama = '$nama', harga = $harga, stok = $stok WHERE id = $id";
    $success = $db->query($sql);

    if ($success) {
        flash_messages(['Data produk telah diedit!']);
        redirect('index.php');
    } else {
        flash_errors(['Data produk gagal diedit!']);
        redirect('');
    }
}

$sql = "SELECT * FROM produk WHERE id = $$id";
$form = $db->query($sql)->fetch_assoc();

?>

<?php
$title = 'Edit Produk';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>