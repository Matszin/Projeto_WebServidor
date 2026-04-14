<?php 
require_once __DIR__ . '/../../models/EventModel.php';
$model = new EventModel();

// Pega o ID da URL. Se não houver, volta para a lista.
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: /index.php?page=eventos");
    exit;
}

$evento = $model->find($id);

if (!$evento) {
    require_once __DIR__ . '/../partials/header.php';
    echo "<div class='layout'>";
    require_once __DIR__ . '/../partials/navbar.php';
    echo "<main class='content'><h1>Evento não encontrado!</h1><a href='/index.php?page=eventos'>Voltar</a></main></div>";
    require_once __DIR__ . '/../partials/footer.php';
    exit;
}

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <a href="/index.php?page=eventos" class="btn-back">← Voltar para a lista</a>
        
        <div class="event-details-container">
            <!-- Banner Genérico (No Trabalho 2 você usará o caminho da imagem do banco) -->
            <img src="https://via.placeholder.com/900x450" alt="Banner do Evento" class="event-banner">
            
            <h1><?= $evento['titulo'] ?></h1>
            
            <div class="event-info-row">
                <span><strong>📅 Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['data'] )) ?></span>
                <span><strong>📍 Local:</strong> <?= $evento['local'] ?></span>
                <span><strong>🏷️ Tipo:</strong> <?= ucfirst($evento['tipo']) ?></span>
            </div>

            <div class="event-description">
                <h3>Sobre o Evento</h3>
                <p><?= nl2br($evento['descricao']) ?></p>
            </div>

            <button class="btn-subscribe" onclick="alert('Inscrição realizada com sucesso (Simulação)!')">
                Quero me inscrever!
            </button>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
