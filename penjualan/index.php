<?php

require '../start.php';

$sql = "SELECT * FROM penjualan";

// jika difilter
if (isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])) {
    $sql .= " WHERE tanggal_penjualan BETWEEN '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'";
}

$data_penjualan = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Penjualan';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="<?= url('/produk/') ?>" class="btn btn-primary">Buat Penjualan</a>
        <form action="" method="get" class="d-flex justify-content-center align-items-center gap-3">
            <input type="date" name="tgl_awal" id="" value="<?= $_GET['tgl_awal'] ?? date('Y-m-d') ?>" class="form-control" style="width: 10rem;">
            <input type="date" name="tgl_akhir" id="" value="<?= $_GET['tgl_akhir'] ?? date('Y-m-d') ?>" class="form-control" style="width: 10rem;">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <button class="btn btn-primary ms-auto" onclick="window.open('cetak_riwayat.php?<?= $_SERVER['QUERY_STRING'] ?>')">Cetak</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_pendapatan = 0;
            ?>
            <?php foreach ($data_penjualan as $penjualan) : ?>
            <?php $total_pendapatan+= $penjualan['total_harga'] ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $penjualan['tanggal_penjualan'] ?></td>
                    <td><?= rp($penjualan['total_harga']) ?></td>
                    <td class="d-flex gap-3">
                        <a href="detail.php?id=<?= $penjualan['id'] ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Pendapatan</th>
                <th><?= rp($total_pendapatan) ?></th>
            </tr>
        </tfoot>
    </table>
    <?php if (count($data_penjualan) === 0) : ?>
        <div class="text-center">
            <h1>Data Kosong</h1>
        </div>
    <?php endif ?>
</div>

<?php require '../layout/footer.php' ?>