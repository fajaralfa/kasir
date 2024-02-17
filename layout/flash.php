<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endforeach ?>
<?php foreach ($messages as $msg) : ?>
    <div class="alert alert-success"><?= $msg ?></div>
<?php endforeach ?>