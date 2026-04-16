<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';

$email = $_SESSION['user'] ?? '';
$inscricoes = $_SESSION['inscricoes'][$email] ?? [];
?>

<div class="layout">

    <div class="content">
        <main class="content">

            <h1>Meus Eventos Inscritos</h1>
            <p>Aqui estão os eventos que você se inscreveu</p>

            <?php if (empty($inscricoes)): ?>
                <p>Você ainda não se inscreveu em nenhum evento.</p>
            <?php else: ?>
                <ul class="event-list">
                    <?php foreach ($inscricoes as $eventoId): ?>
                        <li class="event-item">
                            Evento ID: <?= $eventoId ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </main>
    </div>

</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>