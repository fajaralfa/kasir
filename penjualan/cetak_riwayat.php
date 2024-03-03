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
$title = 'Cetak Data Penjualan';
require '../layout/head.php';
?>

<div class="container border py-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
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
</div>

<script>
    window.print()
    window.close()
</script>