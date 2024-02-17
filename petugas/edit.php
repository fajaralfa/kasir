<?php

require '../start.php';

$id = $_GET['id'];

if(request_is('POST')) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $sql = "UPDATE petugas SET nama = '$nama', username = '$username',
        password = '$password', level = '$level' WHERE id = $id";

    try {
        $db->query($sql);
        flash_messages(['Data petugas telah diedit!']);
        redirect('index.php');
    } catch (mysqli_sql_exception $e) {
        flash_errors([ 'Data petugas gagal didedit!', $e->getMessage() ]);
        redirect('');
    }
}

$sql = "SELECT * FROM petugas WHERE id = $id";
$form = $db->query($sql)->fetch_assoc();

?>

<?php
$title = 'Edit Petugas';
require '../layout/header.php';
require 'form.php';
require '../layout/footer.php';
?>