<?php

require '../start.php';

$id = $_GET['id'];
$sql = "DELETE FROM pelanggan WHERE id = $id";
$success = $db->query($sql);

if ($success) {
    flash_messages(['Data telah dihapus!']);
    redirect('index.php');
} else {
    flash_errors(['Data gagal dihapus!']);
    redirect('index.php');
}