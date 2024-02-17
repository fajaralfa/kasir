<?php

require '../start.php';

require '../system/keranjang.php';
$data_keranjang = keranjang_all();

$pelanggan_id = $_GET['id'];
$sql = "SELECT * FROM pelanggan WHERE id = $pelanggan_id";
$pelanggan = $db->query($sql)->fetch_assoc();

?>

<?php
$title = 'Data Keranjang';
require '../layout/header.php';
?>

<div class="container border py-3">
    <div class="d-grid" style="grid-template-columns: auto auto; max-width: 30rem;">
        <div>Nama Pelanggan</div><div>: <?= $pelanggan['nama'] ?></div>
        <div>Alamat</div><div>: <?= $pelanggan['alamat'] ?></div>
        <div>Nomor Telepon</div><div>: <?= $pelanggan['nomor_telepon'] ?></div>
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
            foreach ($data_keranjang as $key => $val) : ?>
            <?php
            $subtotal = (int) $val['harga'] * (int) $val['jumlah'];
            $total += $subtotal;
            ?>
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
    <form action="transaksi.php" method="post" class="d-flex gap-3">
        <input type="hidden" name="pelanggan_id" value="<?= $pelanggan_id ?>">
        <input type="hidden" name="total" value="<?= $total ?>" id="">
        <input type="date" name="tanggal_penjualan" id="" value="<?= date('Y-m-d') ?>" class="form-control" style="max-width: 10rem;">
        <button class="btn btn-primary">Buat Transaksi</button>
    </form>
</div>

<?php require '../layout/footer.php' ?>