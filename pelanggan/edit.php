<?php

require '../start.php';

$id = $_GET['id'];

if(request_is('POST')) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = "UPDATE pelanggan SET nama = '$nama',
        alamat = '$alamat', nomor_telepon = '$nomor_telepon' WHERE id = $id";
    $success = $db->query($sql);

    if ($success) {
        flash_messages(['Data pelanggan telah diedit!']);
        redirect('index.php');
    } else {
        flash_errors(['Data pelanggan gagal diedit!']);
        redirect('');
    }
}

$sql = "SELECT * FROM pelanggan WHERE id = $id";
$form = $db->query($sql)->fetch_assoc();

?>

<?php
$title = 'Edit Pelanggan';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>