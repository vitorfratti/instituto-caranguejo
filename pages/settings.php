<?php

session_start();
if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id, ['name']);

?>

<section class="settings" data-page="settings">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>CONFIGURAÇÕES</h3>
                    <p>Atualize e gerencie suas informações aqui    </p>
                </span>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-register.php'; ?>
</section>