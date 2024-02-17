<?php

require '../start.php';

flash_messages(['Pilih atau masukan data pelanggan terlebih dahulu!']);
redirect(uri('/pelanggan/'));