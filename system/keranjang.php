<?php

function keranjang_has($id)
{
    return array_key_exists($id, $_SESSION['produk'] ?? []);
}

function keranjang_insert($id, $nama, $harga, $jumlah)
{
    if (keranjang_has($id)) {
        $_SESSION['produk'][$id]['jumlah'] += $jumlah;
        return;
    }

    $_SESSION['produk'][$id] = [
        'nama' => $nama,
        'harga' => $harga,
        'jumlah' => $jumlah,
    ];
}

function keranjang_all()
{
    return $_SESSION['produk'] ?? [];
}

function keranjang_remove($index)
{
    unset($_SESSION['produk'][$index]);
}

function keranjang_destroy()
{
    unset($_SESSION['produk']);
}