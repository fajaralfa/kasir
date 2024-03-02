<?php

/**
 * file ini berisi konfigurasi, koneksi database, dan mengimport file function,
 * agar kita tidak perlu membuat konfigurasi di setiap halaman.
 * */

session_start(); // menyalakan session (agar variabel $_SESSION bisa diakses)
date_default_timezone_set('Asia/Jakarta'); // mengatur zona waktu

require __DIR__ . '/system/db.php'; // import koneksi database
require __DIR__ . '/system/functions.php'; // import functions

// ambil data dari session agar bisa langsung digunakan dan lebih praktis
$user = session_get('user'); // ambil data user yang login
$messages = session_get('messages'); // ambil data pesan
$errors = session_get('errors'); // ambil data pesan error

/** Cek perizinan halaman */
$url_saat_ini = parse_url($_SERVER['REQUEST_URI'])['path']; // data url saat ini

if ($url_saat_ini === url('/')) { // jika url yang akses adalah /kasir/
    redirect(url('/index.php')); // maka alihkan ke /index.php
}

// halaman - halaman yang dapat diakses oleh user berdasarkan level
$level_perizinan = [
    'nobody' => [ // halaman yang bisa diakses jika usernya belum login
        '/index.php', '/login.php',
    ],
    'admin' => [ // halaman yang bisa diakses jika level user yang login adalah admin
        '/index.php', '/penjualan/', '/petugas/', '/produk/', '/dashboard.php', '/logout.php',
    ],
    'petugas' => [ // halaman yang bisa diakses jika level user yang login adalah petugas
        '/index.php', '/keranjang/', '/penjualan/', '/produk/', '/dashboard.php', '/logout.php',
    ]
];

$diizinkan = false; // atur perizinan menjadi false (tidak diizinkan) terlebih dahulu
$halaman_yang_diizinkan = $level_perizinan[$user['level'] ?? 'nobody']; // pilih daftar url berdasarkan level user
foreach ($halaman_yang_diizinkan as $url) { // baca url yang bisa diakses satu per satu

    if (strpos($url_saat_ini, url($url)) === 0) { // jika url saat ini mirip dengan salah satu yang ada di daftar halaman,
        $diizinkan = true; // maka ubah perizinan menjadi true (diizinkan)
        break; // lalu hentikan perulangan karena telah diizinkan
    }

    // jika url yang diakses saat ini tidak ada yang mirip dengan yang ada di daftar halaman, maka perizinannya berarti masih false (tidak diizinkan)
}

if (! $diizinkan) { // jika perizinannya false (tidak diizinkan)
    flash_errors(['Anda tidak bisa mengakses halaman ini!']); // kirimkan pesan error sesuai keinginan
    redirect_back(); // kembali ke halaman sebelumnya
}