<?php

if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';
include_once __DIR__ . '/../controllers/projects.php';
include_once __DIR__ . '/../controllers/activities.php';

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['id', 'name', 'role', 'approved']);

$role = $user_info['role'];
$is_approved = $user_info['approved'];

$filter_name = isset($_GET['name']) ? $_GET['name'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$activity_slug = isset($_GET['activity_slug']) ? $_GET['activity_slug'] : '';
$activity_info = get_activity_info($activity_slug);
$activity_slug = $activity_info['slug'];
$activity_id = $activity_info['id'];

$students = get_students_by_activity($activity_id, $filter_name, $page);
$total_students = get_total_student_count_by_activity($activity_id, $filter_name);
$total_pages = ceil($total_students / 30);

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
                        <button class="add-student-activity">ADICIONAR ALUNO</button>
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
            <div class="students">
                <?php if(count($students) > 0): ?>
                    <?php foreach($students as $user): ?>
                        <div class="card" data-role="<?= $user['role'] ?>">
                            <div class="left">
                                <span class="infos">
                                    <h5><?= $user['name'] ?></h5>
                                    <p><?= $user['email'] ?></p>
                                </span>
                            </div>
                            <div class="right">
                                <?php if(intval($user['approved']) != 1): ?>
                                    <span class="approved"> 
                                        <img src="<?= base_url('assets/images/svg/pending.svg') ?>" alt="pending" title="Aprovação Pendente">
                                    </span>
                                <?php endif; ?>
                                <div class="score">
                                    <?php $score = get_score_from_student($user['id'], $activity_id); ?>
                                    <?php if($score != null): ?>
                                        <button class="score-btn">
                                            <h6>
                                                NOTA: <strong><?= $score ?></strong>
                                                <img src="<?= base_url('assets/images/svg/arrow-drop.svg') ?>" alt="arrow-drop">
                                            </h6>
                                        </button>
                                        <div class="score-card" style="display: none;">
                                            <form method="POST" id="update-score-activity">
                                                <input type="hidden" name="set-score-activity">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="activity_id" value="<?= $activity_id ?>">
                                                <input type="hidden" name="current-activity-url">
                                                <div class="input">
                                                    <input type="number" name="score" placeholder="Nota do aluno" value="<?= $score ?>" required>
                                                </div>
                                                <div class="submit">
                                                    <button type="submit">ATUALIZAR NOTA</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <button class="score-btn">
                                            <h6>
                                                ATRIBUIR NOTA
                                                <img src="<?= base_url('assets/images/svg/arrow-drop.svg') ?>" alt="arrow-drop">
                                            </h6>
                                        </button>
                                        <div class="score-card" style="display: none;">
                                            <form method="POST" id="set-score-activity">
                                                <input type="hidden" name="set-score-activity">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="activity_id" value="<?= $activity_id ?>">
                                                <input type="hidden" name="current-activity-url">
                                                <div class="input">
                                                    <input type="number" name="score" placeholder="Nota do aluno" required>
                                                </div>
                                                <div class="submit">
                                                    <button type="submit">ENVIAR NOTA</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(intval($role) == 1 || (intval($role) == 2 && $user['id'] != $user_id && $is_approved && intval($user['role']) == 3)): ?>
                                    <button class="options-btn">
                                        <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                    </button>
                                    <div class="options-card" style="display: none;">
                                        <form method="POST" id="remove-user-from-activity">
                                            <input type="hidden" name="remove-user-from-activity">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="activity_id" value="<?= $activity_id ?>">
                                            <input type="hidden" name="current-activity-url">
                                            <button type="button">
                                                REMOVER DA ATIVIDADE
                                                <img src="<?= base_url('assets/images/svg/trash.svg') ?>" alt="trash">
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
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
                    <?php if ($page < $total_pages - 1): ?>
                        <a
                        href="?page=<?= $total_pages ?>&name=<?= urlencode($filter_name) ?>" class="next">
                            ... <?= $total_pages ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-add-student-activity.php'; ?>
</section>