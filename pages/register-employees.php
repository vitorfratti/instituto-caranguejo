<?php

session_start();
if (isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/'));
    exit;
}

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

?>

<section class="auth">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <div class="container">
        <div class="content">
            <div class="title">
                <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
                <h2>CADASTRO DE FUNCIONÁRIOS</h2>
                <p>Preencha suas informações para fazer seu cadastro</p>
            </div>
            <?php include __DIR__ . '/../partials/form-register-employees.php'; ?>
            <div class="login">
                <p>Já tem uma conta? <a href="<?= base_url('/login') ?>">Entre aqui</a></p>
            </div>
        </div>
    </div>
</section>