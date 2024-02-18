<?php

require '../start.php';

$sql = "SELECT * FROM pelanggan";
if (isset($_GET['nama'])) $sql .= " WHERE nama LIKE '%$_GET[nama]%'";
$data_pelanggan = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Pelanggan';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="tambah.php">Tambah Pelanggan</a>
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
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_pelanggan as $pelanggan) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $pelanggan['nama'] ?></td>
                    <td><?= $pelanggan['alamat'] ?></td>
                    <td><?= $pelanggan['nomor_telepon'] ?></td>
                    <td>
                        <a href="<?= uri("/penjualan/konfirmasi.php?id=$pelanggan[id]") ?>" class="btn btn-primary">Buat Penjualan</a>
                        <a href="edit.php?id=<?= $pelanggan['id'] ?>" class="btn btn-secondary">Edit</a>
                        <a href="hapus.php?id=<?= $pelanggan['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require '../layout/footer.php' ?>