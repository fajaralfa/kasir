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
    /** */
    $req_url = $_SERVER['REQUEST_URI']; // ambil data url saat ini
    $path = parse_url($req_url)['path']; // pisahkan data url dari data request
    $root = explode('/', $path)[1];

    $result = "/$root$url";
    return $result;
}

/**
 * cek metode request
 */
function request_is($method)
{
    return $method == $_SERVER['REQUEST_METHOD'];
}

/**
 * mengalihkan halaman
 */
function redirect($url)
{
    header("location: $url");
    die;
}

/** kembali ke halaman sebelumnya */
function redirect_back()
{
    $last_url = session_get('last_url', '');
    $current_url = $_SERVER['REQUEST_URI'];
    if (! $last_url && $current_url !== url('/login.php')) {
        redirect(url('/login.php'));
    } else {
        redirect($last_url);
    }
}

/**
 * membuat / mengedit nilai session
 */
function session_set($key, $value)
{
    $_SESSION[$key] = $value;
}

/**
 * mengambil nilai session
 */
function session_get($key, $default = [])
{
    return $_SESSION[$key] ?? $default;
}

/**
 * menghapus nilai session
 */
function session_remove($key)
{
    $_SESSION[$key] = [];
}

/**
 * menghapus nilai flash session
 */
function session_unflash()
{
    session_remove('errors');
    session_remove('messages');
}

/**
 * membuat pesan errors
 */
function flash_errors($texts)
{
    session_set('errors', $texts);
}

/**
 * membuat pesan
 */
function flash_messages($texts)
{
    session_set('messages', $texts);
}

/**
 * 
 */
function option_selected($value1, $value2)
{
    return $value1 === $value2 ? 'selected' : '';
}

/**
 * 
 */

function bs_active($url)
{
    $req_url = $_SERVER['REQUEST_URI'];
    return strpos($req_url, url($url)) === 0 ? 'active' : '';
}

/** memformat nilai uang */
function rp($nilai_uang)
{
    $angka = number_format($nilai_uang, 0, ',', '.');
    return "Rp. $angka,-";
}