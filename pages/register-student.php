<?php ?>

<section class="auth">
    <div class="container">
        <div class="content">
            <div class="title">
                <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
                <h2>CADASTRO DE ALUNOS</h2>
                <p>Preencha suas informações para fazer seu cadastro</p>
            </div>
            <form
            id="register-student"
            method="POST"
            action="../controllers/register-student.php">
                <input type="hidden" name="form_type" value="create_student">
                <div class="flex">
                    <span data-input="name">
                        <div class="input">
                            <img
                            src="<?= base_url('assets/images/svg/profile.svg') ?>"
                            alt="profile">
                            <input type="text" name="name" placeholder="Nome completo">
                        </div>
                        <p class="invalid-text none">O nome deve ser preenchido.</p>
                    </span>
                    <span data-input="registration-number">
                        <div class="input">
                            <input type="number" name="registration-number" placeholder="Número da matrícula">
                        </div>
                        <p class="invalid-text none">Esse campo deve ser preenchido.</p>
                    </span>
                    <span data-input="course">
                        <div class="input">
                            <input type="text" name="course" placeholder="Curso">
                        </div>
                        <p class="invalid-text none">Esse campo deve ser preenchido.</p>
                    </span>
                    <span data-input="year">
                        <div class="input">
                            <input type="text" name="year" placeholder="Série/Ano">
                        </div>
                        <p class="invalid-text none">Esse campo deve ser preenchido.</p>
                    </span>
                    <span data-input="institution">
                        <div class="input">
                            <input type="text" name="institution" placeholder="Instituição">
                        </div>
                        <p class="invalid-text none">Esse campo deve ser preenchido.</p>
                    </span>
                    <span data-input="hours-to-be-validated">
                        <div class="input">
                            <input type="text" name="hours-to-be-validated" placeholder="Horas a validar">
                        </div>
                        <p class="invalid-text none">Esse campo deve ser preenchido.</p>
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
                    <span data-input="phone">
                        <div class="input">
                            <img
                            src="<?= base_url('assets/images/svg/phone.svg') ?>"
                            alt="phone">
                            <input type="text" name="phone" class="mask-cel" placeholder="Telefone Celular">
                        </div>
                        <p class="invalid-text none">O telefone deve estar no formato correto.</p>
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
                            <input type="password" name="confirm-password" placeholder="Confirmar senha">
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
                </div>
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