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
        <a href="<?= uri('/produk/index.php') ?>">Pilih Produk</a>
        <form action="" method="get" class="d-flex gap-3">
            <input type="text" name="nama" id="" class="form-control">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
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
            <?php $no = 1;
            foreach ($data_keranjang as $key => $val) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $val['nama'] ?></td>
                    <td><?= $val['harga'] ?></td>
                    <td><?= $val['jumlah'] ?></td>
                    <td><?= $val['harga'] * $val['jumlah'] ?></td>
                    <td>
                        <a href="hapus.php?id=<?= $key ?>" class="btn btn-danger" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div>
        <a href="pilih_pelanggan.php" class="btn btn-primary">Buat Penjualan</a>
    </div>
</div>

<?php require '../layout/footer.php' ?>