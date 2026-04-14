<?php 
require_once __DIR__ . '/../../models/EventModel.php';
$model = new EventModel();
$eventos = $model->all();

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <h1>Explorar Eventos</h1>
        <p>Confira os próximos eventos disponíveis:</p>

        <div class="event-grid">
            <?php foreach ($eventos as $evento): ?>
                <div class="event-card">
                    <div class="event-card-body">
                        <h3><?= $evento['titulo'] ?></h3>
                        <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['data'])) ?></p>
                        <p><strong>Local:</strong> <?= $evento['local'] ?></p>
                        
                        <span class="badge-tipo">
                            <?= $evento['tipo'] ?>
                        </span>
                        
                        <div class="event-card-footer">
                            <a href="/index.php?page=detalhes-evento&id=<?= $evento['id'] ?>" class="btn-details">Ver detalhes →</a>
                            <a href="/index.php?page=editar-evento&id=<?= $evento['id'] ?>" class="btn-edit">Editar ✏️</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>
