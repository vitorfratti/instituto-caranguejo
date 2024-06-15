<div class="overlay-modal-register" style="display: none;">
    <div class="modal-register">
        <div class="header">
            <span>
                <h3>Adicionar Usuário</h3>
                <p>Preencha as informações para adicionar o usuário na plataforma</p>
            </span>
            <button class="close-btn">
                <img
                src="<?= base_url('assets/images/svg/close.svg') ?>"
                alt="email">
            </button>
        </div>
        <div class="main">
            <div class="types">
                <button data-role="2">
                    <img
                    src="<?= base_url('assets/images/svg/user.svg') ?>"
                    alt="user">
                    <h4>FUNCIONÁRIO</h4>
                </button>
                <button data-role="3">
                    <img
                    src="<?= base_url('assets/images/svg/aluno.svg') ?>"
                    alt="aluno">
                    <h4>ALUNO</h4>
                </button>
            </div>
            <div
            class="form-register-employees form-register"
            data-role="2"
            style="display: none;">
                <?php include __DIR__ . '/../partials/form-register-employees.php'; ?>
            </div>
            <div
            class="form-register-student form-register"
            data-role="3"
            style="display: none;">
                <?php include __DIR__ . '/../partials/form-register-student.php'; ?>
            </div>
        </div>
    </div>
</div>