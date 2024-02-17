<?php

require '../start.php';

$id = $_GET['id'];
$sql = "DELETE FROM petugas WHERE id = $id";
$success = $db->query($sql);

flash_messages(['Data telah dihapus!']);
redirect('index.php');