<?php

session_start();
if (!isset($_COOKIE['isAuth'])) {
    header("Location: " . base_url('/tipos-de-cadastro'));
    exit;
}

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id, ['name']);

?>

<section class="home" data-page="home">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="main">
        <?php include __DIR__ . '/../partials/topbar.php'; ?>
        <div class="content">
            <div class="header">
                <span>
                    <h3>BEM-VINDO, <?= $user_info['name'] ?> 👋</h3>
                    <p>Explore a plataforma e gerencie o instituto com facilidade e eficiência!</p>
                </span>
            </div>
            <div class="banner">
                <img
                src="<?= base_url('assets/images/instituto-banner.jpg') ?>"
                alt="banner">
            </div>
            <div class="text">
                <h5><strong>Bem-vindo à Plataforma do Instituto Caranguejo</strong></h5>
                <p>Explore uma nova era de aprendizado e descoberta com a nossa plataforma dedicada ao gerenciamento de projetos e atividades ambientais. Aqui no Instituto Caranguejo, estamos comprometidos com a educação ambiental e o desenvolvimento sustentável, capacitando nossos alunos a transformarem ideias em ação.</p>
                <br/>
                <h5><strong>O que oferecemos:</strong></h5>
                <p>Gerenciamento de Projetos: Crie, planeje e gerencie projetos de forma eficiente e colaborativa.</p>
                <p>Atividades Acadêmicas: Acompanhe e participe de atividades acadêmicas que promovem a educação ambiental.</p>
                <p>Interação e Colaboração: Conecte-se com colegas, professores e mentores para colaborar em projetos e compartilhar ideias.</p>
                <p>Recursos Educacionais: Acesse uma vasta gama de recursos educacionais sobre conservação ambiental, biodiversidade e sustentabilidade.</p>
                <br/>
                <h5><strong>Por que escolher o Instituto Caranguejo:</strong></h5>
                <p>No Instituto Caranguejo, acreditamos que cada ação conta. Ao utilizar nossa plataforma, você não apenas desenvolve suas habilidades acadêmicas, mas também contribui para um futuro sustentável.</p>
                <p>Junte-se a nós e faça a diferença!</p>
                <p>Pronto para começar? Registre-se agora e comece sua jornada para um mundo melhor.</p>
                <p>Conecte-se. Colabore. Conserve.</p>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../partials/modal-register.php'; ?>
</section>