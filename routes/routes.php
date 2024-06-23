<?php

$route = isset($_GET['url']) ? $_GET['url'] : '';

function is_project_route($route) {
    return preg_match('/^projeto\/([a-zA-Z0-9-]+)$/', $route);
}

function is_activity_route($route) {
    return preg_match('/^projeto\/([a-zA-Z0-9-]+)\/([a-zA-Z0-9-]+)$/', $route);
}

if (is_project_route($route)) {
    preg_match('/^projeto\/([a-zA-Z0-9-]+)$/', $route, $matches);
    $slug = $matches[1];
    $file = './pages/project-single.php';
    $_GET['slug'] = $slug;
} elseif (is_activity_route($route)) {
    preg_match('/^projeto\/([a-zA-Z0-9-]+)\/([a-zA-Z0-9-]+)$/', $route, $matches);
    $project_slug = $matches[1];
    $activity_slug = $matches[2];
    $file = './pages/activity-single.php';
    $_GET['project_slug'] = $project_slug;
    $_GET['activity_slug'] = $activity_slug;
} else {
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
}

include $file;

?>