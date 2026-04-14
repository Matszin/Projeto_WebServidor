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

        <div class="event-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php foreach ($eventos as $evento): ?>
                <div class="event-card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    
                    <div style="padding: 15px;">
                        <h3 style="margin-bottom: 10px;"><?= $evento['titulo'] ?></h3>
                        <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['data'])) ?></p>
                        <p><strong>Local:</strong> <?= $evento['local'] ?></p>
                        <span style="display: inline-block; background: #38bdf8; color: #020617; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-top: 10px;">
                            <?= $evento['tipo'] ?>
                        </span>
                        
                        <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <a href="#" style="text-decoration: none; color: #38bdf8; font-weight: bold;">Ver detalhes →</a>
                            
                            <!--link para página de edição passando o id-->
                            <a href="/index.php?page=editar-evento&id=<?= $evento['id'] ?>" style="text-decoration: none; color: #eab308; font-weight: bold;">Editar ✏️</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
