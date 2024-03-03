<?php

require '../start.php';

$id = $_GET['id'];

// metadata penjualan
$sql = "SELECT * FROM penjualan WHERE id = $id";
$penjualan = $db->query($sql)->fetch_assoc();

// produk yang dibeli
$sql = "SELECT produk.nama, produk.harga, detail_penjualan.jumlah_produk, detail_penjualan.subtotal
    FROM detail_penjualan
    LEFT JOIN produk ON detail_penjualan.produk_id = produk.id
    WHERE detail_penjualan.penjualan_id = $id";
$detail_penjualan = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Cetak Detail Penjualan';
require '../layout/head.php';
?>

<div class="container border py-3"> 
    <div>Tanggal Penjualan : <?= $penjualan['tanggal_penjualan'] ?></div>
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
            <?php foreach ($detail_penjualan as $produk) : ?>
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
                <th><?= rp($penjualan['total_harga']) ?></th>
            </tr>
            <tr>
                <th colspan="3">Uang Masuk</th>
                <th><?= rp($penjualan['uang_masuk']) ?></th>
            </tr>
            <tr>
                <th colspan="3">Kembalian</th>
                <th><?= rp($penjualan['uang_masuk'] - $penjualan['total_harga']) ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    window.print() // cetak halaman
    window.close() // tutup halaman setelah menutup cetakan
</script>