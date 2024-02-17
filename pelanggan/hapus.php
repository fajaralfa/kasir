<?php

require '../start.php';

$id = $_GET['id'];
$sql = "DELETE FROM pelanggan WHERE id = $id";

try {
    $db->query($sql);
    flash_messages(['Data pelanggan telah dihapus!']);
} catch (mysqli_sql_exception $e) {
    flash_errors([
        'Tidak dapat menghapus pelanggan, pelanggan sudah melakukan transaksi!',
    ]);
}

redirect('index.php');