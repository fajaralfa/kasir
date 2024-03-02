<?php

/**
 * Function adalah sekumpulan kode program yang melakukan/memproses sesuatu,
 * dan bisa juga mengeluarkan/mengembalikan hasil dari prosesnya.
 * Contoh:
 * function tambah($a, $b) {
 *      $c = $a + $b;
 *      return $c;
 * }
 * function ini bernama tambah, function ini menerima dua input yaitu a dan b,
 * function ini menjumlahkan (memproses) bilangan dari a dan b lalu mengeluarkan/mengembalikan hasilnya.
 * 
 * Kegunaan function adalah untuk mengurangi duplikasi / copy paste kode program.
 * dengan function, kita tinggal memanggil nama function dengan inputnya dan kode program
 * didalam function tersebut akan dipanggil secara otomatis.
 * 
 * dibawah ini adalah function yang digunakan di aplikasi ini (bagian atas function menjelaskan kegunaan functionnya)
 */

/** membuat alamat url berdasarkan folder proyek */
function url($url)
{
    /**
     * $_SERVER['REQUEST_URI'] akan berisi:
     * '/nama_folder_proyek/nama_folder/nama_file' atau '/nama_folder_proyek/nama_file'
     */
    $req_url = $_SERVER['REQUEST_URI']; // ambil data url saat ini
    $path = parse_url($req_url)['path']; // pisahkan data path dari data request
    $data_kata = explode('/', $path); // pisahkan setiap kata dengan garis miring
    $nama_proyek = $data_kata[1]; // ambil data kedua (ingat, data pertama diakses dengan angka 0, data kedua diakses dengan angka 1, dst)
    $result = "/$nama_proyek$url"; // gabungkan nama_folder_proyek dengan url target
    return $result; // keluarkan hasilnya
}

/** cek metode request yang dikirim (GET, POST, PUT, PATCH, dll) */
function request_is($method)
{
    // bandingkan apakah method dari webnya ($_SERVER['REQUEST_METHOD']) sama dengan yang diharapkan ($method)
    return $method === $_SERVER['REQUEST_METHOD'];
}

/** mengalihkan halaman */
function redirect($url)
{
    header("location: $url"); // atur header 'location' sesuai $url yang diminta
    die; // lalu jangan jalankan apapun lagi
}

/** kembali ke halaman sebelumnya */
function redirect_back()
{
    $last_url = session_get('last_url', null); // ambil data url sebelumnya, jika tidak ada maka kosongkan
    $current_url = $_SERVER['REQUEST_URI']; // ambil data url saat ini

    // cek jika tidak ada url sebelumnya, dan url saat ini bukan halaman login, maka alihkan ke halaman login
    if (is_null($last_url) && $current_url !== url('/login.php')) {
        redirect(url('/login.php'));
    } else {
        // jika ada maka pindah ke halaman sebelumnya
        redirect($last_url);
    }
}

/**
 * atur data session dengan kata kunci $key menjadi $value,
 * contoh:
 * atur data user di session, menjadi data yang berisi nama user, username, level, dll
 */
function session_set($key, $value)
{
    $_SESSION[$key] = $value;
}

/**
 * mengambil data dengan kata kunci $key dari dari session
 * contoh:
 * ambil data user dari session, jika datanya tidak ada maka berikan nilai bawaan
 */
function session_get($key, $default = [])
{
    return $_SESSION[$key] ?? $default;
}

/**
 * menghapus nilai session (mengosongkan)
 */
function session_remove($key)
{
    $_SESSION[$key] = [];
}

/**
 * membuat pesan errors
 * pesan ini hanya akan muncul sekali,
 * jadi jika halamannya direfresh lagi maka pesannya tidak ada
 */
function flash_errors($texts)
{
    session_set('errors', $texts);
}

/**
 * membuat pesan
 * pesan ini hanya akan muncul sekali,
 * jadi jika halamannya direfresh lagi maka pesannya tidak ada
 */
function flash_messages($texts)
{
    session_set('messages', $texts);
}

/**
 * menghapus nilai flash session
 * function ini berfungsi untuk mengosongkan pesan dan pesan error.
 * function ini hanya dipakai sekali, yaitu di layout/footer.php.
 * kenapa dibagian footer? karena jika misalkan di header atau di bagian body,
 * kemungkinan pesannya akan terhapus sebelum muncul,
 * jadi lebih baik disimpan di bagian bawah (footer.php)
 * agar pesannya masih sempat muncul sebelum dihapus
 */
function session_unflash()
{
    session_remove('errors');
    session_remove('messages');
}

/**
 * mengembalikan selected, jika $value1 dan $value2 sesuai
 * contoh:
 * $value1 adalah nilai level petugas dari database
 * $value2 adalah nilai level petugas yang diinginkan
 * jika level di $value1 dan $value2 memiliki nilai sama (misalkan nilainya 'admin'),
 * maka function ini akan mengeluarkan teks 'selected'
 * function ini dipakai di dalam elemen option html
 */
function option_selected($value1, $value2)
{
    return $value1 === $value2 ? 'selected' : '';
}

/**
 * mengembalikan teks selected, jika url yang diakses memiliki awalan url yang diminta
 * contoh: 
 * url yang diminta = '/keranjang'
 * url yang diakses = '/keranjang/index.php'
 */
function bs_active($url)
{
    $req_url = $_SERVER['REQUEST_URI']; // ambil data url

    // cek apakah url yang diakses memiliki awalan url yang diminta
    return strpos($req_url, url($url)) === 0 ? 'active' : '';
}

/**
 * memformat angka dengan format rupiah
*/
function rp($nilai_uang)
{
    $angka = number_format($nilai_uang, 0, null, '.');
    return "Rp. $angka,-"; // contoh Rp. 10.000,-
}