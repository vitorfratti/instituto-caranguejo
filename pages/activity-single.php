<?php

if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';
include_once __DIR__ . '/../controllers/projects.php';
include_once __DIR__ . '/../controllers/activities.php';

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['name', 'role', 'approved']);

$role = $user_info['role'];
$is_approved = $user_info['approved'];

$filter_name = isset($_GET['name']) ? $_GET['name'] : '';

$activity_slug = isset($_GET['activity_slug']) ? $_GET['activity_slug'] : '';
$activity_info = get_activity_info($activity_slug);
$activity_slug = $activity_info['slug'];
$activity_id = $activity_info['id'];

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

?>

<section class="activity-single" data-page="projects">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3><?= $activity_info['name'] ?></h3>
                    <p>Aqui ficam as informações da atividade</p>
                </span>
                <span>
                    <?php
                        $date = new DateTime($activity_info['date']);
                        $formatted_date = $date->format('d/m/Y');
                    ?>
                    <p><?= $formatted_date ?></p>
                    <?php if(intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                        <button class="add-student">ADICIONAR ALUNO</button>
                    <?php endif; ?>
                </span>
            </div>
            <div class="filter">
                <form action="" method="GET" id="filter-project-form">
                    <div class="input">
                        <input id="filter-project-name" type="text" name="name" placeholder="Filtrar por nome" value="<?= htmlspecialchars($filter_name) ?>">
                        <button type="submit">
                            <img src="<?= base_url('assets/images/svg/search.svg') ?>" alt="search">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-create-activity.php'; ?>
</section>