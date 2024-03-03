<?php
// File ini berfungsi untuk melakukan operasi 'CRUD' pada data keranjang
// Data keranjang disimpan di Session, bukan di Database

/**
 * cek apakah keranjang memiliki barang dengan id yang diinput
 */
function keranjang_has($id)
{
    return array_key_exists($id, $_SESSION['keranjang'] ?? []);
}

/**
 * menyimpan data produk ke keranjang,
 * jika produk sudah ada, maka jumlahnya akan ditambahkan
 */
function keranjang_insert($id, $nama, $harga, $jumlah)
{
    // cek apakah di keranjang sudah ada produk dengan id yang diinput (function keranjang_has)
    if (keranjang_has($id)) {
        // jika ada maka tambahkan saja jumlahnya
        $_SESSION['keranjang'][$id]['jumlah'] += $jumlah;
        return;
    } else {
        // jika barang dengan id tersebut tidak ada, maka simpan data produk ke keranjang
        $_SESSION['keranjang'][$id] = [
            'nama' => $nama,
            'harga' => $harga,
            'jumlah' => $jumlah,
        ];
    }
}

/**
 * mengambil semua data produk yang ada di keranjang
 */
function keranjang_all()
{
    // '??' adalah operator nullish coalescing
    // fungsinya untuk memberikan nilai bawaan jika nilai yang diinginkan tidak ada
    // contoh:
    // echo $year ?? 2024;
    // kode di atas berfungsi untuk menampilkan nilai dari variabel $year
    // tapi karena variabel $year tidak ada, maka yang akan ditampilkan adalah 2024
    return $_SESSION['keranjang'] ?? [];
}

/**
 * menghapus data produk dengan id yang diinput dari keranjang
 */
function keranjang_remove($id)
{
    unset($_SESSION['keranjang'][$id]);
}

/**
 * menghapus semua data produk di keranjang
 */
function keranjang_destroy()
{
    unset($_SESSION['keranjang']);
}