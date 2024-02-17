<?php

$arr = [
    ['id' => 1, 'nama' => 'ke 1'],
    ['id' => 2, 'nama' => 'ke 2'],
    ['id' => 3, 'nama' => 'ke 3'],
];

unset($arr[1]);
var_dump($arr);