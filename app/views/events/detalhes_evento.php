<?php
require_once __DIR__ . '/../../models/EventModel.php';
$model = new EventModel();

// Pega o ID da URI  — /eventos/{id}/detalhes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
preg_match('#^/eventos/(\d+)/detalhes$#', $uri, $m);
$id = $m[1] ?? null;

if (!$id) {
    header("Location: /");
    exit;
}

$evento = $model->find($id);

if (!$evento) {
    require_once __DIR__ . '/../partials/header.php';
    echo "<div class='layout'>";
    require_once __DIR__ . '/../partials/navbar.php';
    echo "<main class='content'><h1>Evento não encontrado!</h1><a href='/'>Voltar</a></main></div>";
    require_once __DIR__ . '/../partials/footer.php';
    exit;
}

require_once __DIR__ . '/../partials/header.php';
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <a href="/" class="btn-back">← Voltar para a lista</a>

        <div class="event-details-container">
            <h1><?= $evento['titulo'] ?></h1>

            <div class="event-info-row">
                <span><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['data'])) ?></span>
                <span><strong>Local:</strong> <?= $evento['local'] ?></span>
                <span><strong>Tipo:</strong> <?= ucfirst($evento['tipo']) ?></span>
            </div>

            <div class="event-description">
                <h3>Sobre o Evento</h3>
                <p><?= nl2br($evento['descricao']) ?></p>
            </div>

            <a href="/eventos/<?= $evento['id'] ?>/inscrever" class="btn-subscribe">
                Quero me inscrever!
            </a>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
