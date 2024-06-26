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

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$project_info = get_project_info($slug);
$project_slug = $project_info['slug'];
$project_id = $project_info['id'];

$activities = get_all_activities($filter_name, $limit, $offset, $project_id);
$total_activities = count_all_activities($filter_name, $project_id);
$total_pages = ceil($total_activities / $limit);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_activity_id'])) {
    $activity_id_to_delete = intval($_POST['delete_activity_id']);
    $current_project_url = $_POST['current-project-url'];
    delete_activity($activity_id_to_delete, $current_project_url);
    exit;
}

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

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
                    <?php
                        $date = new DateTime($project_info['date']);
                        $formatted_date = $date->format('d/m/Y');
                    ?>
                    <p><?= $formatted_date ?></p>
                    <?php if(intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                        <button class="create-activity">ADICIONAR ATIVIDADE</button>
                    <?php endif; ?>
                </span>
            </div>
            <?php if(count($activities) > 0): ?>
                <div class="filter">
                    <form action="" method="GET" id="filter-activity-form">
                        <div class="input">
                            <input id="filter-activity-name" type="text" name="name" placeholder="Filtrar por nome" value="<?= htmlspecialchars($filter_name) ?>">
                            <button type="submit">
                                <img src="<?= base_url('assets/images/svg/search.svg') ?>" alt="search">
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <div class="cards">
                <?php if(count($activities) > 0): ?>
                    <?php foreach($activities as $activity): ?>
                        <?php
                            $date = new DateTime($activity['date']);
                            $formatted_date = $date->format('d/m/Y');
                        ?>
                        <div class="card" data-id="<?= $activity['id'] ?>">
                            <div class="top">
                                <p><?= $formatted_date ?></p>
                                <?php if (intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                                    <button class="options-btn">
                                        <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                    </button>
                                    <div class="options-card" style="display: none;">
                                        <form method="POST" id="delete-activity">
                                            <input type="hidden" name="delete_activity_id" value="<?= $activity['id'] ?>">
                                            <input type="hidden" name="current-project-url">
                                            <button type="button">
                                                REMOVER ATIVIDADE
                                                <img src="<?= base_url('assets/images/svg/trash.svg') ?>" alt="trash">
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mid">
                                <h4><?= $activity['name'] ?></h4>
                            </div>
                            <div class="bottom">
                                <?php
                                    $count_students = get_total_student_count_by_activity($activity['id'], null);
                                ?>
                                <p>
                                    <?php if ($count_students > 0): ?>
                                        <?= $count_students . ($count_students > 1 ? ' alunos' : ' aluno'); ?>
                                    <?php else: ?>
                                        Nenhum aluno
                                    <?php endif; ?>
                                </p>
                            </div>
                            <a href="<?= base_url('/projeto/' . $project_slug . '/' . $activity['slug']) ?>" class="see-activity">VER ATIVIDADE</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="not-found">Nenhuma atividade encontrada.</p>
                <?php endif; ?>
            </div>
            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <p>Página: </p>
                    <?php if ($page > 2): ?>
                        <a href="?page=1&name=<?= urlencode($filter_name) ?>&slug=<?= urlencode($slug) ?>" class="next">
                            1 ...
                        </a>
                    <?php endif; ?>
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&name=<?= urlencode($filter_name) ?>&slug=<?= urlencode($slug) ?>" class="prev">
                            <?= $page - 1 ?>
                        </a>
                    <?php endif; ?>
                    <span class="current">
                        <p><?= $page ?></p>
                    </span>
                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?= $page + 1 ?>&name=<?= urlencode($filter_name) ?>&slug=<?= urlencode($slug) ?>" class="next">
                            <?= $page + 1 ?>
                        </a>
                    <?php endif; ?>
                    <?php if (($page + 1) < $total_pages): ?>
                        <a href="?page=<?= $total_pages ?>&name=<?= urlencode($filter_name) ?>&slug=<?= urlencode($slug) ?>" class="next">
                            ... <?= $total_pages ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-create-activity.php'; ?>
</section>