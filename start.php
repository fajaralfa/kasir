<?php

session_start(); // memulai session
date_default_timezone_set('Asia/Jakarta'); // atur zona waktu

require __DIR__ . '/system/db.php'; // import koneksi db
require __DIR__ . '/system/functions.php'; // import functions

// ambil data dari session agar bisa langsung digunakan dan lebih praktis
$user = session_get('user');
$messages = session_get('messages');
$errors = session_get('errors');