<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/EventModel.php';
require_once __DIR__ . '/../../models/UserModel.php';

$model     = new EventModel();
$userModel = new UserModel();

$email = $_SESSION['user'] ?? null;

if (!$email) {
    header("Location: /login");
    exit;
}

$user      = $userModel->findByEmail($email);
$inscricoes = $model->eventosInscritos($user['id']);

require_once __DIR__ . '/../partials/header.php';
?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="content">

        <h1>Meus Eventos Inscritos</h1>
        <p>Aqui estão os eventos que você se inscreveu</p>

        <?php if (empty($inscricoes)): ?>
            <p>Você ainda não se inscreveu em nenhum evento.</p>
        <?php else: ?>
            <ul class="event-list">
                <?php foreach ($inscricoes as $evento): ?>
                    <li class="event-item">
                        <strong><?= $evento['titulo'] ?></strong><br>
                        Data: <?= date('d/m/Y H:i', strtotime($evento['data'])) ?><br>
                        Local: <?= $evento['local'] ?><br>
                        Tipo: <?= ucfirst($evento['tipo']) ?><br>

                        <a href="/eventos/<?= $evento['id'] ?>/cancelar" class="btn-cancel">
                            Cancelar inscrição
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
