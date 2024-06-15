<?php

session_start();
if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id, ['name', 'email', 'role']);

$name = $user_info['name'];
$email = $user_info['email'];
$role = $user_info['role'];

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
            <div class="infos">
                <form action="">
                    <span>
                        <label>Nome:</label>
                        <div class="input">
                            <input type="text" value="<?= $name ?>">
                        </div>
                    </span>
                    <span>
                        <label>Email:</label>
                        <div class="input">
                            <input type="email" value="<?= $email ?>">
                        </div>
                    </span>
                    <span>
                        <label>Nova Senha:</label>
                        <div class="input">
                            <input type="password" value="">
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
                    </span>
                    <span>
                        <label>Usuário:</label>
                        <div class="input">
                            <input type="text" value="<?= intval($role) == 1 ? 'Admin' : (intval($role) == 2 ? 'Funcionário' : 'Aluno') ?>" readonly disabled>
                        </div>
                    </span>
                    <div class="buttons">
                        <button type="button" class="cancel">CANCELAR</button>
                        <button type="submit" class="submit">SALVAR ALTERAÇÕES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-register.php'; ?>
</section>