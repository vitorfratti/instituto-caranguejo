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

$projects = get_all_projects();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_project_id'])) {
    $project_id_to_delete = intval($_POST['delete_project_id']);
    delete_project($project_id_to_delete);
    exit;
}

?>

<section class="projects" data-page="projects">
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
                    <?php if (intval($role) == 1 || intval($role) == 2): ?>
                        <button class="create-project">CRIAR PROJETO</button>
                    <?php endif; ?>
                </span>
            </div>
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
                                <button class="options-btn">
                                    <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                </button>
                                <div class="options-card" style="display: none;">
                                    <form method="POST" id="delete-project">
                                        <input type="hidden" name="delete_project_id" value="<?= $project['id'] ?>">
                                        <button type="button">REMOVER PROJETO</button>
                                    </form>
                                </div>
                            </div>
                            <div class="mid">
                                <h4><?= $project['name'] ?></h4>
                            </div>
                            <div class="bottom"></div>
                            <a href="#" class="see-project">VER PROJETO</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="not-found">Nenhum resultado encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-create-project.php'; ?>
</section>