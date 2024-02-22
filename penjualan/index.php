<?php

require '../start.php';

$sql = "SELECT penjualan.id, penjualan.tanggal_penjualan, pelanggan.nama, pelanggan.nomor_telepon,
    penjualan.total_harga FROM penjualan LEFT JOIN pelanggan
    ON penjualan.pelanggan_id = pelanggan.id";
$data_penjualan = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Penjualan';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="<?= uri('/produk/') ?>">Buat Penjualan</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Telepon</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($data_penjualan as $penjualan) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $penjualan['tanggal_penjualan'] ?></td>
                    <td><?= $penjualan['nama'] ?></td>
                    <td><?= $penjualan['nomor_telepon'] ?></td>
                    <td><?= rp($penjualan['total_harga']) ?></td>
                    <td class="d-flex gap-3">
                        <a href="detail.php?id=<?= $penjualan['id'] ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require '../layout/footer.php' ?>