<?php

    $route = isset($_GET['url']) ? $_GET['url'] : '';

    if ($route == 'tipos-de-cadastro') {
        include './pages/register-types.php';
    } elseif ($route == 'cadastro/admin') {
        include './pages/register-admin.php';
    }

?>