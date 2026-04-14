<?php 
require_once __DIR__ . '/../../models/EventModel.php';

$model = new EventModel();

$id = $_GET['id'] ?? 1;

$evento = $model->find($id);

if (!$evento) {
    echo "<h1>Evento não encontrado!</h1>";
    exit;
}

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <h1>Editar Evento</h1>
        <p>Editando: <strong><?= $evento['titulo'] ?></strong></p>

        <div class="container-form">
            <form action="/app/controllers/EventController.php?action=update&id=<?= $evento['id'] ?>" method="POST">
                
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?= $evento['titulo'] ?>" required>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Data</label>
                        <input type="datetime-local" name="data_evento" value="<?= $evento['data'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo_evento">
                            <option value="academico" <?= $evento['tipo'] == 'academico' ? 'selected' : '' ?>>Acadêmico</option>
                            <option value="corporativo" <?= $evento['tipo'] == 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Local</label>
                    <input type="text" name="local" value="<?= $evento['local'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="5"><?= $evento['descricao'] ?></textarea>
                </div>

                <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn-primary" style="padding: 10px 20px; background: #38bdf8; border: none; font-weight: bold; cursor: pointer;">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
