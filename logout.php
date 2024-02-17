<?php

require 'start.php';

session_destroy();
redirect('login.php');