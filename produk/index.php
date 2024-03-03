<?php

require '../start.php';

$sql = "SELECT * FROM produk";
if (isset($_GET['nama']))
    $sql .= " WHERE nama LIKE '%$_GET[nama]%'";
if (isset($_GET['order_by']) && isset($_GET['order']))
    $sql .= " ORDER BY $_GET[order_by] $_GET[order]";

$data_produk = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Produk';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <?php if ($user['level'] === 'admin') : ?>
            <a href="tambah.php" class="btn btn-primary">Tambah Produk</a>
        <?php endif ?>
        <form action="" method="get" class="d-flex gap-3">
            <input type="text" name="nama" id="" placeholder="Nama Produk" class="form-control">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
        <a href="?order_by=stok&order=ASC" class="ms-auto btn btn-warning">Urutkan Dari Stok Terkecil</a>
        <a href="?order_by=stok&order=DESC" class="btn btn-warning">Urutkan Dari Stok Terbesar</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_produk as $produk) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $produk['nama'] ?></td>
                    <td><?= rp($produk['harga']) ?></td>
                    <td><?= $produk['stok'] ?></td>
                    <td class="d-flex gap-3">
                        <?php if ($user['level'] === 'petugas') : ?>
                            <form action="ke_keranjang.php" method="post" class="d-flex gap-3">
                                <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
                                <input type="hidden" name="nama" value="<?= $produk['nama'] ?>">
                                <input type="hidden" name="harga" id="" value="<?= $produk['harga'] ?>">
                                <input type="hidden" name="stok" value="<?= $produk['stok'] ?>">
                                <input type="number" name="jumlah" value="1" class="form-control" style="max-width: 5rem;">
                                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                            </form>
                        <?php elseif ($user['level'] === 'admin') : ?>
                            <a href="edit.php?id=<?= $produk['id'] ?>" class="btn btn-secondary">Edit</a>
                            <a href="hapus.php?id=<?= $produk['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                            <form action="tambah_stok.php" method="post" class="ms-3 d-flex gap-3">
                                <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                                <input type="number" name="stok_baru" value="0" class="form-control" style="max-width: 5rem;">
                                <button type="submit" class="btn btn-primary">Tambah Stok</button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if (count($data_produk) === 0) : ?>
        <div class="text-center">
            <h1>Data Kosong</h1>
        </div>
    <?php endif ?>
</div>

<?php require '../layout/footer.php' ?>