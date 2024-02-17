<?php

require 'start.php';

if (session_get('user', null) == null) {
    redirect('login.php');
}

redirect('dashboard.php');