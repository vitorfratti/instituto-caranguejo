<?php

$route = isset($_GET['url']) ? $_GET['url'] : '';

switch ($route) {
    case 'tipos-de-cadastro':
        $file = './pages/register-types.php';
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
    case 'membros':
        $file = './pages/members.php';
        break;
    case 'configuracoes':
        $file = './pages/settings.php';
        break;
    case 'projetos':
        $file = './pages/projects.php';
        break;
    case '':
        $file = './pages/home.php';
        break;
    default:
        header("Location: " . base_url('/'));
        exit;
}


include $file;

?>
