<?php

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define('BASE_URL', 'http://localhost/instituto-caranguejo/');
}

function base_url($path) {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

?>