<?php

function keranjang_has($id)
{
    return array_key_exists($id, $_SESSION['keranjang'] ?? []);
}

function keranjang_insert($id, $nama, $harga, $jumlah)
{
    if (keranjang_has($id)) {
        $_SESSION['keranjang'][$id]['jumlah'] += $jumlah;
        return;
    }

    $_SESSION['keranjang'][$id] = [
        'nama' => $nama,
        'harga' => $harga,
        'jumlah' => $jumlah,
    ];
}

function keranjang_all()
{
    return $_SESSION['keranjang'] ?? [];
}

function keranjang_remove($index)
{
    unset($_SESSION['keranjang'][$index]);
}

function keranjang_destroy()
{
    unset($_SESSION['keranjang']);
}