<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie('isAuth', '', time() - 3600, '/');
    
    header("Location: " . base_url('/login'));
    exit;
}

?>
