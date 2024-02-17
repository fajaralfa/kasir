<div class="container" style="max-width: 30rem;">
    <div class="h2 text-center"><?= $title ?? '' ?></div>
    <form action="" method="post" class="d-flex flex-column gap-3">
        <div>
            <label for="nama">Nama Produk</label>
            <input type="text" name="nama" value="<?= $form['nama'] ?? '' ?>" id="" placeholder="Nama Produk" class="form-control">
        </div>
        <div>
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="<?= $form['harga'] ?? '' ?>" id="" placeholder="Harga" class="form-control">
        </div>
        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" value="<?= $form['stok'] ?? '' ?>" id="" placeholder="Stok" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary"><?= $title ?? '' ?></button>
        </div>
    </form>
</div>