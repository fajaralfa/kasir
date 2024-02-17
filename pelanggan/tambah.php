<?php

require '../start.php';

if(request_is('POST')) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = "INSERT INTO pelanggan (nama, alamat, nomor_telepon) VALUES
        ('$nama', '$alamat', '$nomor_telepon')";
    $success = $db->query($sql);

    if ($success) {
        flash_messages(['Data pelanggan telah disimpan!']);
        redirect('index.php');
    } else {
        flash_errors(['Data pelanggan gagal disimpan!']);
        redirect('');
    }
}

?>

<?php
$title = 'Tambah Pelanggan';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>