<?php

$route = isset($_GET['url']) ? $_GET['url'] : '';

switch ($route) {
    case 'tipos-de-cadastro':
        $file = './pages/register-types.php';
        break;
    case 'cadastro/admin':
        $file = './pages/register-admin.php';
        break;
    case 'cadastro/funcionario':
        $file = './pages/register-employees.php';
        break;
    case 'cadastro/aluno':
        $file = './pages/register-student.php';
        break;
    case 'login':
        $file = './pages/login.php';
        break;
    default:
        echo "Rota não encontrada";
        exit;
}

include $file;

?>
