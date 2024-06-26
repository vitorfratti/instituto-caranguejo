<?php

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_COOKIE['user_id'];
$user_info = get_user_info($user_id, ['role']);

$role = $user_info['role'];

?>

<div class="overlay-modal-add-student-activity overlay" style="display: none;">
    <div class="modal-add-student-activity">
        <div class="header">
            <span>
                <h3>Adicionar Alunos</h3>
                <p>Preencha as informações para adicionar os alunos na atividade</p>
            </span>
            <button class="close-btn">
                <img
                src="<?= base_url('assets/images/svg/close.svg') ?>"
                alt="close">
            </button>
        </div>
        <div class="main">
            <?php include __DIR__ . '/../partials/form-add-student-activity.php'; ?>
        </div>
    </div>
</div>