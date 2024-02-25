<?php
require 'start.php';

if (request_is('POST')) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    $user = $db->query($sql)->fetch_assoc();

    if (is_null($user)) {
        flash_errors(['Username atau password salah']);
        redirect('login.php');
    } else {
        unset($user['password']);
        session_set('user', $user);
        redirect('dashboard.php');
    }
}

?>

<?php
$title = 'Login';
require 'layout/head.php';
require 'layout/flash.php';
?>

<div class="container-fluid py-5" style="max-width: 30rem;">
    <form action="" method="post" class="d-flex flex-column gap-3">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

<?php require 'layout/footer.php' ?>