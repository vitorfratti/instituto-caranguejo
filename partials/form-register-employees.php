<?php

$route = isset($_GET['url']) ? $_GET['url'] : '';

if($route == 'membros') {
    $redirect_success = '/membros';
    $redirect_error = '/membros';
} elseif($route == 'cadastro/funcionario') {
    $redirect_success = '/login';
    $redirect_error = '/cadastro/funcionario';
}

?>

<form
class="form"
id="register-employees"
action="<?= base_url('/controllers/register-employees.php') ?>"
method="POST">
    <input type="hidden" name="redirect_success" value="<?= $redirect_success ?>">
    <input type="hidden" name="redirect_error" value="<?= $redirect_error ?>">
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