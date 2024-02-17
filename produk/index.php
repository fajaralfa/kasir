<?php

require '../start.php';

$sql = "SELECT * FROM produk";
if (isset($_GET['nama'])) $sql .= " WHERE nama LIKE '%$_GET[nama]%'";
$data_produk = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Produk';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="tambah.php">Tambah Produk</a>
        <form action="" method="get" class="d-flex gap-3">
            <input type="text" name="nama" id="" class="form-control">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
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
                    <td><?= $produk['harga'] ?></td>
                    <td><?= $produk['stok'] ?></td>
                    <td class="d-flex gap-3">
                        <form action="ke_keranjang.php" method="post" class="d-flex gap-3">
                            <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
                            <input type="hidden" name="nama" value="<?= $produk['nama'] ?>">
                            <input type="hidden" name="harga" id="" value="<?= $produk['harga'] ?>">
                            <input type="number" name="jumlah" value="1" class="form-control" style="max-width: 5rem;">
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                        <a href="edit.php?id=<?= $produk['id'] ?>" class="btn btn-secondary">Edit</a>
                        <a href="hapus.php?id=<?= $produk['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require '../layout/footer.php' ?>