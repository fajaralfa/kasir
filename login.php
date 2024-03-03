<?php
require 'start.php';

// Cek jika formulir login dikirim
if (request_is('POST')) {

    // ambil data form username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ambil data petugas dengan username dan password dari formulir
    $sql = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    $user = $db->query($sql)->fetch_assoc();

    if (is_null($user)) { // jika data petugasnya tidak ada (login gagal)
        
        // tampilkan pesan error
        flash_errors(['Username atau password salah']);

        // kembali ke halaman login
        redirect('login.php');

    } else { // jika data petugasnya ada (login berhasil)

        /** hapus data password petugas
         * karena nanti data petugas seperti username, nama, level
         * akan disimpan di session, jika password disimpan juga di session
         * takutnya nanti passwordnya bocor dan tampil di browser
         * */
        unset($user['password']);

        // simpan data petugas di session
        session_set('user', $user);

        // pindah ke dashboard
        redirect('dashboard.php');
    }
}

?>

<?php
$title = 'Login'; // judul halaman
require 'layout/head.php'; // bagian head
require 'layout/flash.php'; // bagian pesan info dan error
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

<?php require 'layout/footer.php' // bagian footer ?>