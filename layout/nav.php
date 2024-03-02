<nav class="navbar bg-primary">
    <a href="<?= url('/dashboard.php') ?>" class="btn btn-primary <?= bs_active('/dashboard') ?>">
        Dashboard
    </a>
    <a href="<?= url('/penjualan/') ?>" class="btn btn-primary <?= bs_active('/penjualan/') ?>">
        Riwayat Penjualan
    </a>
    <a href="<?= url('/produk/') ?>" class="btn btn-primary <?= bs_active('/produk/') ?>">
        Produk
    </a>
    <?php if ($user['level'] == 'admin') : ?>
        <a href="<?= url('/petugas/') ?>" class="btn btn-primary <?= bs_active('/petugas/') ?>">
            Petugas
        </a>
    <?php elseif ($user['level'] == 'petugas') : ?>
        <a href="<?= url('/keranjang/') ?>" class="btn btn-primary <?= bs_active('/keranjang/') ?>">
            Keranjang (<?= count(session_get('keranjang')) ?>)
        </a>
    <?php endif ?>
    <div class="fw-bold text-white ms-auto px-2"><?= "{$user['nama']} | {$user['level']}" ?></div>
    <a href="<?= url('/logout.php') ?>" onclick="return confirm('Keluar?')" class="btn btn-primary">
        Logout
    </a>
</nav>