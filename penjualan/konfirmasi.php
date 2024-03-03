<?php

require '../start.php';

require '../system/keranjang.php';
$data_keranjang = keranjang_all();

?>

<?php
$title = 'Konfirmasi Penjualan';
require '../layout/header.php';
?>

<div class="container border py-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($data_keranjang as $key => $val) : ?>
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
    <form action="proses.php" method="post" id="form-konfirmasi-penjualan" class="d-flex flex-column gap-2" style="max-width: 10rem;">
        <input type="hidden" name="total" value="<?= $total ?>" id="">
        <input type="date" name="tanggal_penjualan" id="" value="<?= date('Y-m-d') ?>" class="form-control">
        <input type="number" name="uang_masuk" id="" placeholder="Jumlah Uang" class="form-control">
        <div id="teks-kembalian"></div>
        <div>
            <button class="btn btn-primary">Buat Penjualan</button>
        </div>
    </form>
</div>

<script>
    const formKonfirmasiPenjualan = document.querySelector('#form-konfirmasi-penjualan')
    const teksKembalian = document.querySelector('#teks-kembalian')
    const inputUangMasuk = document.querySelector('input[name=uang_masuk]')
    const totalHarga = <?= $total ?>

    inputUangMasuk.addEventListener('input', function(e) {
        let uangMasuk = e.currentTarget.value
        if (uangMasuk < totalHarga) {
            teksKembalian.classList = 'alert alert-warning py-1'
            teksKembalian.innerText = `Uang Kurang!`
        } else {
            teksKembalian.classList = 'alert alert-success py-1'
            teksKembalian.innerText = `Kembalian: ${uangMasuk - totalHarga}`
        }
    })

    formKonfirmasiPenjualan.addEventListener('submit', function(e) {
        if (inputUangMasuk.value < totalHarga) {
            e.preventDefault()
            alert('Uang Kurang!')
        }
    })
</script>

<?php require '../layout/footer.php' ?>