<?php

if (isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/'));
    exit;
}

?>

<section class="register-types">
    <div class="container">
        <div class="content">
            <div class="title">
                <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
                <h2>FAÇA SEU CADASTRO</h2>
                <p>Selecione o tipo de usuário da sua conta</p>
            </div>
            <div class="types">
                <a href="<?= base_url('/cadastro/funcionario') ?>">
                    <img
                    src="<?= base_url('assets/images/svg/user.svg') ?>"
                    alt="user">
                    <h4>FUNCIONÁRIO</h4>
                </a>
                <a href="<?= base_url('/cadastro/aluno') ?>">
                    <img
                    src="<?= base_url('assets/images/svg/aluno.svg') ?>"
                    alt="aluno">
                    <h4>ALUNO</h4>
                </a>
            </div>
            <div class="login">
                <p>Já tem uma conta? <a href="<?= base_url('/login') ?>">Entre aqui</a></p>
            </div>
        </div>
    </div>
</section>