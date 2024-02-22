<?php

/** membuat alamat uri berdasarkan folder proyek */
function uri($uri)
{
    $req_uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($req_uri)['path'];
    $root = explode('/', $path)[1];

    $result = "/$root$uri";
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
function redirect($uri)
{
    header("location: $uri");
    die;
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

function bs_active($uri)
{
    $req_uri = $_SERVER['REQUEST_URI'];
    return str_starts_with($req_uri, uri($uri)) ? 'active' : '';
}

/** memformat nilai uang */
function rp($nilai_uang)
{
    $angka = number_format($nilai_uang, 0, ',', '.');
    return "Rp. $angka,-";
}