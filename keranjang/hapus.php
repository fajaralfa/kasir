<?php

require '../start.php';
require '../system/keranjang.php';

$id = $_GET['id'];
keranjang_remove($id);

flash_messages(['Produk berhasil dihapus dari keranjang!']);
redirect('index.php');