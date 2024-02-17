<nav class="navbar bg-primary">
    <a href="<?= uri('/dashboard.php') ?>" class="btn btn-primary">Dashboard</a>
    <a href="<?= uri('/penjualan/') ?>" class="btn btn-primary">Penjualan</a>
    <a href="<?= uri('/produk/') ?>" class="btn btn-primary">Produk</a>
    <a href="<?= uri('/keranjang/') ?>" class="btn btn-primary">Keranjang</a>
    <a href="<?= uri('/pelanggan/') ?>" class="btn btn-primary">Pelanggan</a>
    <?php if ($user['level'] == 'admin') : ?>
        <a href="<?= uri('/petugas/') ?>" class="btn btn-primary">Petugas</a>
    <?php endif ?>
    <div class="fw-bold text-white ms-auto px-2"><?= "{$user['nama']} | {$user['level']}" ?></div>
    <a href="<?= uri('/logout.php') ?>" onclick="return confirm('Keluar?')" class="btn btn-primary">Logout</a>
</nav>