<?php

require '../start.php';


if (request_is('POST')) {
    $id = $_POST['id'];

    $stok_lama = $db->query("SELECT stok FROM produk WHERE id = $id")->fetch_assoc()['stok'];
    $stok_baru = $_POST['stok_baru'];

    if ($stok_baru < 1) {
        flash_errors(['Stok baru tidak boleh kurang dari satu!']);
        redirect_back();
    }

    $stok = $stok_lama + $stok_baru;
    $sql = "UPDATE produk SET stok = $stok WHERE id = $id";
    $db->query($sql);

    flash_messages(["Stok telah ditambah sebanyak $stok_baru!"]);
    redirect_back();
}


?>