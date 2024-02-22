<?php

require '../start.php';

$id = $_GET['id'];

// metadata penjualan
$sql = "SELECT penjualan.tanggal_penjualan, pelanggan.nama, pelanggan.alamat, pelanggan.nomor_telepon,
    penjualan.total_harga FROM penjualan
    LEFT JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.id WHERE penjualan.id = $id";
$penjualan = $db->query($sql)->fetch_assoc();

// produk yang dibeli
$sql = "SELECT produk.nama, produk.harga, detail_penjualan.jumlah_produk, detail_penjualan.subtotal
    FROM detail_penjualan
    LEFT JOIN produk ON detail_penjualan.produk_id = produk.id
    WHERE detail_penjualan.penjualan_id = $id";
$detail_penjualan = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Detail Penjualan';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-grid" style="grid-template-columns: 10rem auto;">
        <div>Tanggal Penjualan</div>
        <div>: <?= $penjualan['tanggal_penjualan'] ?></div>
        <div>Nama Pelanggan</div>
        <div>: <?= $penjualan['nama'] ?></div>
        <div>Alamat</div>
        <div>: <?= $penjualan['alamat'] ?></div>
        <div>Nomor Telepon</div>
        <div>: <?= $penjualan['nomor_telepon'] ?></div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0 ?>
            <?php foreach ($detail_penjualan as $produk) : ?>
            <?php $total += $produk['subtotal'] ?>
                <tr>
                    <td><?= $produk['nama'] ?></td>
                    <td><?= rp($produk['harga']) ?></td>
                    <td><?= $produk['jumlah_produk'] ?></td>
                    <td><?= rp($produk['subtotal']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Harga</th>
                <th><?= rp($total) ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php require '../layout/footer.php' ?>