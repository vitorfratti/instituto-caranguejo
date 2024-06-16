<?php

session_start();
if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id, ['name', 'email', 'role', 'password']);

$name = $user_info['name'];
$email = $user_info['email'];
$role = $user_info['role'];
$current_password = $user_info['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user_id'])) {
    $new_name = $_POST['new-name'];
    $new_email = $_POST['new-email'];
    $new_password = $_POST['new-password'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    } else {
        $hashed_password = $current_password;
    }

    $result = edit_user($user_id, $new_name, $new_email, $hashed_password);

    if ($result === true) {
        $_SESSION['user_info'] = get_user_info($user_id, ['name', 'email', 'role', 'password']);
        header("Location: " . base_url('/configuracoes'));
        exit;
    }
}

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error'])

?>

<section class="settings" data-page="settings">
    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>CONFIGURAÇÕES</h3>
                    <p>Atualize e gerencie suas informações aqui</p>
                </span>
            </div>
            <div class="infos">
                <form method="POST" action="" id="edit-user">
                    <input type="hidden" name="edit_user_id" value="<?= $user_id ?>">
                    <span>
                        <label>Nome:</label>
                        <div class="input">
                            <input
                            type="text"
                            name="new-name"
                            value="<?= htmlspecialchars($name) ?>"
                            data-value="<?= htmlspecialchars($name) ?>"
                            class="settings-field">
                        </div>
                    </span>
                    <span>
                        <label>Email:</label>
                        <div class="input">
                            <input type="email"
                            name="new-email"
                            value="<?= htmlspecialchars($email) ?>"
                            data-value="<?= htmlspecialchars($email) ?>"
                            class="settings-field">
                        </div>
                    </span>
                    <span>
                        <label>Nova Senha:</label>
                        <div class="input">
                            <input
                            type="password"
                            name="new-password"
                            value=""
                            data-value=""
                            class="settings-field">
                            <button type="button" class="hide-show">
                                <img class="eye-hide" src="<?= base_url('assets/images/svg/eye-hide.svg') ?>" alt="eye-hide">
                                <img class="eye-show" src="<?= base_url('assets/images/svg/eye-show.svg') ?>" alt="eye-show" style="display: none;">
                            </button>
                        </div>
                    </span>
                    <span>
                        <label>Usuário:</label>
                        <div class="input">
                            <input
                            type="text"
                            value="<?= intval($role) == 1 ? 'Admin' : (intval($role) == 2 ? 'Funcionário' : 'Aluno') ?>"
                            data-value="<?= intval($role) == 1 ? 'Admin' : (intval($role) == 2 ? 'Funcionário' : 'Aluno') ?>"
                            class="settings-field"
                            readonly
                            disabled>
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