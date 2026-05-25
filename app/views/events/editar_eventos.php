<?php
require_once __DIR__ . '/../../models/EventModel.php';

$model = new EventModel();

// Pega o ID da URI  — /eventos/{id}/editar
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
preg_match('#^/eventos/(\d+)/editar$#', $uri, $m);
$id = $m[1] ?? null;

$evento = $id ? $model->find($id) : null;

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
            <form action="/eventos/<?= $evento['id'] ?>/editar" method="POST">

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
                            <option value="academico"   <?= $evento['tipo'] == 'academico'   ? 'selected' : '' ?>>Acadêmico</option>
                            <option value="corporativo" <?= $evento['tipo'] == 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
                            <option value="cultural"    <?= $evento['tipo'] == 'cultural'    ? 'selected' : '' ?>>Cultural</option>
                            <option value="esportivo"   <?= $evento['tipo'] == 'esportivo'   ? 'selected' : '' ?>>Esportivo</option>
                            <option value="outro"       <?= $evento['tipo'] == 'outro'       ? 'selected' : '' ?>>Outro</option>
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
                    <button type="submit" class="btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
