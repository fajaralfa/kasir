<?php

require '../start.php';

$id = $_GET['id'];
$sql = "DELETE FROM produk WHERE id = $id";

try {
    $db->query($sql);
    flash_messages(['Data produk telah dihapus!']);
} catch (mysqli_sql_exception $e) {
    flash_errors([
        'Tidak dapat menghapus produk, produk sudah pernah dibeli!',
    ]);
}

redirect('index.php');