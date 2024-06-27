<?php

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['role']);

$role = $user_info['role'];

?>

<div class="overlay-modal-create-project overlay" style="display: none;">
    <div class="modal-create-project modal">
        <div class="header">
            <span>
                <h3>Criar Projeto</h3>
                <p>Preencha as informações para criar o projeto</p>
            </span>
            <button class="close-btn">
                <img
                src="<?= base_url('assets/images/svg/close.svg') ?>"
                alt="close">
            </button>
        </div>
        <div class="main">
            <?php include __DIR__ . '/../partials/form-create-project.php'; ?>
        </div>
    </div>
</div>