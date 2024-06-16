<?php

if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';
include_once __DIR__ . '/../controllers/projects.php';

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['name', 'role']);

$role = $user_info['role'];

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$project_info = get_project_info($slug);

?>

<section class="project-single" data-page="projects">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3><?= $project_info['name'] ?></h3>
                    <p><?= $project_info['description'] ?></p>
                </span>
                <span>
                    <?php if (intval($role) == 1 || intval($role) == 2): ?>
                        <button class="create-activity">ADICIONAR ATIVIDADE</button>
                    <?php endif; ?>
                    <?php
                        $date = new DateTime($project_info['date']);
                        $formatted_date = $date->format('d/m/Y');
                    ?>
                    <p><?= $formatted_date ?></p>
                </span>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-create-project.php'; ?>
</section>