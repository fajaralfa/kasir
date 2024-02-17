<?php

require '../start.php';

$sql = "SELECT * FROM petugas";
if (isset($_GET['nama'])) $sql .= " WHERE nama LIKE '%$_GET[nama]%'";
$data_petugas = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>

<?php
$title = 'Data Petugas';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="tambah.php">Tambah Petugas</a>
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
                <th>Username</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_petugas as $petugas) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $petugas['nama'] ?></td>
                    <td><?= $petugas['username'] ?></td>
                    <td><?= $petugas['level'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $petugas['id'] ?>" class="btn btn-secondary">Edit</a>
                        <a href="hapus.php?id=<?= $petugas['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus petugas ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require '../layout/footer.php' ?>