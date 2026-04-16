<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/EventModel.php';
$model = new EventModel();

$email = $_SESSION['user'] ?? null;

if (!$email) {
    header("Location: /public/index.php?page=login");
    exit;
}

$inscricoes = $_SESSION['inscricoes'][$email] ?? [];
?>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="content">

        <h1>Meus Eventos Inscritos</h1>
        <p>Aqui estão os eventos que você se inscreveu</p>

        <?php if (empty($inscricoes)): ?>
            <p>Você ainda não se inscreveu em nenhum evento.</p>
        <?php else: ?>
            <ul class="event-list">
                <?php foreach ($inscricoes as $eventoId):
                    $evento = $model->find($eventoId);
                    if (!$evento) continue;
                ?>
                <li class="event-item">
                    <strong><?= $evento['titulo'] ?></strong><br>
                    Data: <?= date('d/m/Y H:i', strtotime($evento['data'])) ?><br>
                    Local: <?= $evento['local'] ?><br>
                    Tipo: <?= ucfirst($evento['tipo']) ?><br>

                    <a href="/public/index.php?action=cancelar&id=<?= $evento['id'] ?>" 
                       class="btn-cancel">
                        Cancelar inscrição
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>