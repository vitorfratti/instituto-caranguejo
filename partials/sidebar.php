<nav class="sidebar">
    <span>
        <div class="logo">
            <img src="<?= base_url('assets/images/svg/logo.svg') ?>" alt="logo">
        </div>
        <div class="links">
            <a
            data-page="home"
            href="<?= base_url('/') ?>">HOME</a>
            <a
            data-page="members"
            href="<?= base_url('/membros') ?>">MEMBROS</a>
            <a
            data-page="projects"
            href="<?= base_url('/projetos') ?>">PROJETOS</a>
            <a
            data-page="settings"
            href="<?= base_url('/configuracoes') ?>">CONFIGURAÇÕES</a>
        </div>
    </span>
    <div class="logout">
        <form
        action="<?= base_url('/controllers/logout.php') ?>"
        method="POST">
            <button type="submit">SAIR DA CONTA</button>
        </form>
    </div>
</nav>