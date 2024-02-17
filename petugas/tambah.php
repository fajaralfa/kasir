<?php

require '../start.php';

if(request_is('POST')) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $sql = "INSERT INTO petugas (nama, username, password, level) VALUE
        ('$nama', '$username', '$password', '$level')";

    try {
        $db->query($sql);
        flash_messages(['Data petugas telah disimpan!']);
        redirect('index.php');
    } catch (mysqli_sql_exception $e) {
        flash_errors([ 'Data petugas gagal disimpan!', $e->getMessage() ]);
        redirect('');
    }
}

?>

<?php
$title = 'Tambah Petugas';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>