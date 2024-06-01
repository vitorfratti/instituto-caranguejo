<?php

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define('BASE_URL', 'http://localhost/instituto-caranguejo/');
}

function base_url($path) {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

// Tratamento de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>