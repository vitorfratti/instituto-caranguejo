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
                <h2>FAÇA SEU LOGIN</h2>
                <p>Insira seus dados de acesso</p>
            </div>
            <form
            class="form"
            id="login"
            action="<?= base_url('/controllers/login.php') ?>"
            method="POST">
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/email.svg') ?>"
                    alt="email">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/password.svg') ?>"
                    alt="password">
                    <input type="password" name="password" placeholder="Senha" required>
                    <button type="button" class="hide-show">
                        <img
                        class="eye-hide"
                        src="<?= base_url('assets/images/svg/eye-hide.svg') ?>"
                        alt="eye-hide">
                        <img
                        class="eye-show"
                        src="<?= base_url('assets/images/svg/eye-show.svg') ?>"
                        alt="eye-show"
                        style="display: none;">
                    </button>
                </div>
                <div class="forgot">
                    <a href="#">Esqueceu sua senha?</a>
                </div>
                <div class="submit">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
            <div class="login">
                <p>Não tem uma conta? <a href="<?= base_url('/tipos-de-cadastro') ?>">Crie aqui</a></p>
            </div>
        </div>
    </div>
</section>
