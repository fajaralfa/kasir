<div class="container" style="max-width: 30rem;">
    <div class="h2 text-center"><?= $title ?? '' ?></div>
    <form action="" method="post" class="d-flex flex-column gap-3">
        <div>
            <label for="nama">Nama Petugas</label>
            <input type="text" name="nama" value="<?= $form['nama'] ?? '' ?>" id="" placeholder="Nama Petugas" class="form-control">
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?= $form['username'] ?? '' ?>" id="" placeholder="Username" class="form-control">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" name="password" value="<?= $form['password'] ?? '' ?>" id="" placeholder="******" class="form-control">
        </div>
        <div>
            <label for="level">Level</label>
            <select name="level" id="" class="form-control">
                <option value="admin" <?= option_selected($form['level'] ?? '', 'admin') ?>>Admin</option>
                <option value="petugas" <?= option_selected($form['level'] ?? '', 'petugas') ?>>Petugas</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary"><?= $title ?? '' ?></button>
        </div>
    </form>
</div>