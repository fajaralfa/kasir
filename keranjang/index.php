<?php

require '../start.php';

require '../system/keranjang.php';
$data_keranjang = keranjang_all();

?>

<?php
$title = 'Data Keranjang';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="<?= url('/produk/index.php') ?>" class="btn btn-primary">Pilih Produk</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            ?>
            <?php foreach ($data_keranjang as $key => $val) : ?>
                <?php
                $subtotal = $val['harga'] * $val['jumlah'];
                $total += $subtotal;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $val['nama'] ?></td>
                    <td><?= rp($val['harga']) ?></td>
                    <td><?= $val['jumlah'] ?></td>
                    <td><?= rp($subtotal) ?></td>
                    <td>
                        <a href="hapus.php?id=<?= $key ?>" class="btn btn-danger" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total Harga</th>
                <th><?= rp($total) ?></th>
            </tr>
        </tfoot>
    </table>
    <div>
        <?php if (count($data_keranjang) > 0) : ?>
            <a href="<?= url('/penjualan/konfirmasi.php') ?>" class="btn btn-primary">Buat Penjualan</a>
        <?php endif ?>
        <?php if (count($data_keranjang) === 0) : ?>
            <div class="text-center">
                <h1>Data Kosong</h1>
            </div>
        <?php endif ?>
    </div>
</div>

<?php require '../layout/footer.php' ?>