<?php

require 'start.php';

session_set('last_url', $_SERVER['REQUEST_URI']);

if ($user) {
    redirect('dashboard.php');
} else {
    redirect('login.php');
}
