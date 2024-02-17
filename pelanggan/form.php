<div class="container" style="max-width: 30rem;">
    <div class="h2 text-center"><?= $title ?? '' ?></div>
    <form action="" method="post" class="d-flex flex-column gap-3">
        <div>
            <label for="nama">Nama Pelanggan</label>
            <input type="text" name="nama" value="<?= $form['nama'] ?? '' ?>" id="" placeholder="Nama Pelanggan" class="form-control">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="" cols="30" rows="3" class="form-control"><?= $form['alamat'] ?? '' ?></textarea>
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="number" name="nomor_telepon" value="<?= $form['nomor_telepon'] ?? '' ?>" id="" placeholder="08xxxxx" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary"><?= $title ?? '' ?></button>
        </div>
    </form>
</div>