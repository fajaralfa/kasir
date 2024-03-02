<?php

require 'start.php';

session_set('last_uri', $_SERVER['REQUEST_URI']);

if ($user) {
    redirect('dashboard.php');
} else {
    redirect('login.php');
}
