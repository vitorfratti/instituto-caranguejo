<?php ?>

<section class="auth">
    <div class="container">
        <div class="content">
            <div class="title">
                <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
                <h2>CADASTRO DE FUNCIONÁRIOS</h2>
                <p>Preencha suas informações para fazer seu cadastro</p>
            </div>
            <form>
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/profile.svg') ?>"
                    alt="profile">
                    <input type="text" placeholder="Nome completo">
                </div>
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/email.svg') ?>"
                    alt="email">
                    <input type="email" placeholder="Email">
                </div>
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/password.svg') ?>"
                    alt="password">
                    <input type="password" placeholder="Senha">
                    <button type="button">
                        <img
                        src="<?= base_url('assets/images/svg/eye.svg') ?>"
                        alt="eye">
                    </button>
                </div>
                <div class="input">
                    <img
                    src="<?= base_url('assets/images/svg/password.svg') ?>"
                    alt="password">
                    <input type="password" placeholder="Confirmar senha">
                    <button type="button">
                        <img
                        src="<?= base_url('assets/images/svg/eye.svg') ?>"
                        alt="eye">
                    </button>
                </div>
                <div class="submit">
                    <button type="submit">FAZER CADASTRO</button>
                </div>
            </form>
            <div class="login">
                <p>Já tem uma conta? <a href="<?= base_url('/login') ?>">Entre aqui</a></p>
            </div>
        </div>
    </div>
</section>