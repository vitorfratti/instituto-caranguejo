<?php

session_start();
if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $user_id_to_delete = intval($_POST['delete_user_id']);
    delete_user($user_id_to_delete);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_role_user_id'])) {
    $user_id_to_change_role = intval($_POST['change_role_user_id']);
    $new_role = intval($_POST['new_role']);

    if (change_role($user_id_to_change_role, $new_role)) {
        header("Location: " . base_url('/membros'));
        exit;
    } else {
        $_SESSION['error'] = "Erro ao tentar alterar o papel do usuário.";
        header("Location: " . base_url('/membros'));
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_user_id'])) {
    $user_id_to_approve = intval($_POST['approve_user_id']);
    if (approve_user($user_id_to_approve)) {
        header("Location: " . base_url('/membros'));
        exit;
    } else {
        $_SESSION['error'] = "Erro ao tentar aprovar o usuário.";
        header("Location: " . base_url('/membros'));
        exit;
    }
}

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['role', 'approved']);

$role = $user_info['role'];
$is_approved = intval($user_info['approved']);

$filter_name = isset($_GET['name']) ? $_GET['name'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$users = get_all_users($filter_name, $page);
$total_users = get_total_user_count($filter_name);
$total_pages = ceil($total_users / 30);

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

?>

<section class="members" data-page="members">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>MEMBROS</h3>
                    <p>Aqui ficam todos os usuários cadastrados na plataforma</p>
                </span>
                <span>
                    <?php if(intval($role) == 1 || (intval($role) == 2 && $is_approved == 1)): ?>
                        <button class="add-user">ADICIONAR USUÁRIO</button>
                    <?php endif; ?>
                </span>
            </div>
            <?php if(count($users) > 0): ?>
                <div class="filter">
                    <form action="" method="GET" id="filter-user-form">
                        <div class="input">
                            <input id="filter-user-name" type="text" name="name" placeholder="Filtrar por nome" value="<?= htmlspecialchars($filter_name) ?>">
                            <button type="submit">
                                <img src="<?= base_url('assets/images/svg/search.svg') ?>" alt="search">
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <div class="users">
                <?php if(count($users) > 0): ?>
                    <?php foreach($users as $user): ?>
                        <div class="card" data-role="<?= $user['role'] ?>">
                            <div class="left">
                                <span class="infos">
                                    <h5><?= $user['name'] ?></h5>
                                    <p><?= $user['email'] ?></p>
                                </span>
                            </div>
                            <div class="right">
                                <?php if(
                                    intval($user['approved']) != 1
                                ): ?>
                                    <span class="approved"> 
                                        <img src="<?= base_url('assets/images/svg/pending.svg') ?>" alt="pending">
                                    </span>
                                <?php endif; ?>
                                <span class="role">
                                    <?php if(intval($user['role']) == 1): ?>
                                        <h6>
                                            ADMIN
                                            <img src="<?= base_url('assets/images/svg/crown.svg') ?>" alt="crown">
                                        </h6>
                                    <?php elseif(intval($user['role']) == 2): ?>
                                        <h6>FUNCIONÁRIO</h6>
                                    <?php else: ?>
                                        <h6>ALUNO</h6>
                                    <?php endif; ?>
                                </span>
                                <?php if(
                                    intval($role) == 1 &&
                                    $user['id'] != $user_id
                                ): ?>
                                    <button class="options-btn">
                                        <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                    </button>
                                    <div class="options-card" style="display: none;">
                                        <?php if(intval($user['role']) != 1 && intval($user['approved']) != 1): ?>
                                            <form action="" method="POST" id="approve-user">
                                                <input type="hidden" name="approve_user_id" value="<?= $user['id'] ?>">
                                                <button type="submit">
                                                    APROVAR USUÁRIO
                                                    <img src="<?= base_url('assets/images/svg/check.svg') ?>" alt="check">
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if(intval($user['role']) == 2 && intval($user['approved']) == 1): ?>
                                            <form action="" method="POST" id="change-role">
                                                <input type="hidden" name="change_role_user_id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="new_role" value="1">
                                                <button type="submit">
                                                    TORNAR ADMIN
                                                    <img src="<?= base_url('assets/images/svg/crown.svg') ?>" alt="crown">
                                                </button>
                                            </form>
                                        <?php elseif(intval($role) == 1 && intval($user['role']) == 1): ?>
                                            <form action="" method="POST" id="change-role">
                                                <input type="hidden" name="change_role_user_id" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="new_role" value="2">
                                                <button type="submit">
                                                    RETIRAR ADMIN
                                                    <img src="<?= base_url('assets/images/svg/crown-line.svg') ?>" alt="crown-line">
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if(intval($role) == 1): ?>
                                            <form method="POST" id="delete-user">
                                                <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                                                <button type="button">
                                                    REMOVER USUÁRIO
                                                    <img src="<?= base_url('assets/images/svg/trash.svg') ?>" alt="trash">
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php elseif(
                                    intval($role) == 2 &&
                                    $user['id'] != $user_id &&
                                    $is_approved &&
                                    intval($user['role'] == 3)
                                ): ?>
                                    <button class="options-btn">
                                        <img src="<?= base_url('assets/images/svg/dots.svg') ?>" alt="dots">
                                    </button>
                                    <div class="options-card" style="display: none;">
                                        <?php if(intval($user['role']) == 3 && intval($user['approved']) != 1): ?>
                                            <form action="" method="POST" id="approve-user">
                                                <input type="hidden" name="approve_user_id" value="<?= $user['id'] ?>">
                                                <button type="submit">APROVAR USUÁRIO</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if(intval($role) == 2 && $user['role'] == 3): ?>
                                            <form method="POST" id="delete-user">
                                                <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                                                <button type="submit">REMOVER USUÁRIO</button>
                                            </form>
                                        <?php endif; ?>
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
    <?php include __DIR__ . '/../partials/modal-register.php'; ?>
</section>
