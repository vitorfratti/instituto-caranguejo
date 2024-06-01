<?php ?>

<section class="auth">
    <div class="container">
        <div class="content">
            <div class="title">
                <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
                <h2>CADASTRO DE FUNCIONÁRIOS</h2>
                <p>Preencha suas informações para fazer seu cadastro</p>
            </div>
            <form
            id="register-employees"
            action="../controllers/register-employees.php"
            method="POST">
                <span data-input="name">
                    <div class="input">
                        <img
                        src="<?= base_url('assets/images/svg/profile.svg') ?>"
                        alt="profile">
                        <input type="text" name="name" placeholder="Nome completo">
                    </div>
                    <p class="invalid-text none">O nome deve ser preenchido.</p>
                </span>
                <span data-input="email">
                    <div class="input">
                        <img
                        src="<?= base_url('assets/images/svg/email.svg') ?>"
                        alt="email">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <p class="invalid-text none">O email deve estar no formato correto.</p>
                </span>
                <span data-input="password">
                    <div class="input">
                        <img
                        src="<?= base_url('assets/images/svg/password.svg') ?>"
                        alt="password">
                        <input type="password" name="password" placeholder="Senha">
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
                    <p class="invalid-text none">A senha deve conter no mínimo 8 caracteres.</p>
                </span>
                <span data-input="confirm-password">
                    <div class="input">
                        <img
                        src="<?= base_url('assets/images/svg/password.svg') ?>"
                        alt="password">
                        <input type="password" placeholder="Confirmar senha">
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
                    <p class="invalid-text none">As senhas devem ser iguais.</p>
                </span>
                <div class="submit">
                    <button type="button">FAZER CADASTRO</button>
                </div>
            </form>
            <div class="login">
                <p>Já tem uma conta? <a href="<?= base_url('/login') ?>">Entre aqui</a></p>
            </div>
        </div>
    </div>
</section>