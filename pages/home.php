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

<section class="home" data-page="home">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>BEM-VINDO, <?= $user_info['name'] ?></h3>
                    <p>Explore a plataforma e gerencie o instituto com facilidade e eficiência!</p>
                </span>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-register.php'; ?>
</section>