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

$projects = get_all_projects($filter_name, $limit, $offset);
$total_projects = count_all_projects($filter_name);
$total_pages = ceil($total_projects / $limit);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_project_id'])) {
    $project_id_to_delete = intval($_POST['delete_project_id']);
    delete_project($project_id_to_delete);
    exit;
}

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

?>

<section class="projects" data-page="projects">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>PROJETOS</h3>
                    <p>Aqui ficam todos os projetos cadastrados na plataforma</p>
                </span>
                <span>
                    <?php if(intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                        <button class="create-project">CRIAR PROJETO</button>
                    <?php endif; ?>
                </span>
            </div>
            <?php if(count($projects) > 0): ?>
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
            <?php endif; ?>
            <div class="cards">
                <?php if(count($projects) > 0): ?>
                    <?php foreach($projects as $project): ?>
                        <?php
                            $date = new DateTime($project['date']);
                            $formatted_date = $date->format('d/m/Y');
                        ?>
                        <div class="card" data-id="<?= $project['id'] ?>">
                            <div class="top">
                                <p><?= $formatted_date ?></p>
                                <?php if (intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                                    <button class="options-btn">
                                        <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                    </button>
                                    <div class="options-card" style="display: none;">
                                        <form method="POST" id="delete-project">
                                            <input type="hidden" name="delete_project_id" value="<?= $project['id'] ?>">
                                            <button type="button">
                                                REMOVER PROJETO
                                                <img src="<?= base_url('assets/images/svg/trash.svg') ?>" alt="trash">
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mid">
                                <h4><?= $project['name'] ?></h4>
                            </div>
                            <div class="bottom">
                                <?php
                                    $count_activities = count_all_activities(null, $project['id']);
                                ?>
                                <p>
                                    <?php if ($count_activities > 0): ?>
                                        <?= $count_activities . ($count_activities > 1 ? ' atividades' : ' atividade'); ?>
                                    <?php else: ?>
                                        Nenhuma atividade
                                    <?php endif; ?>
                                </p>
                            </div>
                            <a href="<?= base_url('/projeto/' . $project['slug']) ?>" class="see-project">VER PROJETO</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="not-found">Nenhum resultado encontrado.</p>
                <?php endif; ?>
            </div>
            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <p>Página: </p>
                    <?php if ($page > 2): ?>
                        <a
                        href="?page=1&name=<?= urlencode($filter_name) ?>" class="next">
                            1 ...
                        </a>
                    <?php endif; ?>
                    <?php if ($page > 1): ?>
                        <a
                        href="?page=<?= $page - 1 ?>&name=<?= urlencode($filter_name) ?>" class="prev">
                            <?= $page - 1 ?>
                        </a>
                    <?php endif; ?>
                    <span class="current">
                        <p><?= $page ?></p>
                    </span>
                    <?php if ($page < $total_pages): ?>
                        <a
                        href="?page=<?= $page + 1 ?>&name=<?= urlencode($filter_name) ?>" class="next">
                            <?= $page + 1 ?>
                        </a>
                    <?php endif; ?>
                    <?php if (($page + 1) < $total_pages): ?>
                        <a
                        href="?page=<?= $total_pages ?>&name=<?= urlencode($filter_name) ?>" class="next">
                            ... <?= $total_pages ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-create-project.php'; ?>
</section>