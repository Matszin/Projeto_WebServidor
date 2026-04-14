<?php 
// 1. Simulação (Mock): No futuro, esses dados virão do banco via Controller
$evento = [
    'id' => 1,
    'titulo' => 'Workshop de PHP Moderno',
    'data' => '2026-05-15T14:00', // Formato para o input datetime-local
    'tipo' => 'academico',
    'local' => 'Auditório Central',
    'descricao' => 'Este é um evento de exemplo que estamos editando.'
];

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <header class="content-header">
            <h1>Editar Evento</h1>
            <p>Altere as informações do evento: <strong><?= $evento['titulo'] ?></strong></p>
        </header>

        <div class="container-form">
            <!-- O action agora aponta para 'update' e passa o ID do evento -->
            <form action="/app/controllers/EventController.php?action=update&id=<?= $evento['id'] ?>" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="titulo">Título do Evento</label>
                    <input type="text" id="titulo" name="titulo" value="<?= $evento['titulo'] ?>" required>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="data_evento">Data e Hora</label>
                        <input type="datetime-local" id="data_evento" name="data_evento" value="<?= $evento['data'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_evento">Tipo de Evento</label>
                        <select id="tipo_evento" name="tipo_evento" required>
                            <option value="corporativo" <?= $evento['tipo'] == 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
                            <option value="academico" <?= $evento['tipo'] == 'academico' ? 'selected' : '' ?>>Acadêmico</option>
                            <option value="cultural" <?= $evento['tipo'] == 'cultural' ? 'selected' : '' ?>>Cultural</option>
                            <option value="esportivo" <?= $evento['tipo'] == 'esportivo' ? 'selected' : '' ?>>Esportivo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="local">Local ou Link</label>
                    <input type="text" id="local" name="local" value="<?= $evento['local'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição Completa</label>
                    <textarea id="descricao" name="descricao" rows="5" required><?= $evento['descricao'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="banner">Alterar Banner (Opcional)</label>
                    <input type="file" id="banner" name="banner" accept="image/*">
                    <small>Deixe em branco para manter a imagem atual.</small>
                </div>

                <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px;">
                    <a href="/index.php?page=eventos" style="padding: 10px 25px; text-decoration: none; color: #666; border: 1px solid #ccc; border-radius: 6px;">Cancelar</a>
                    <button type="submit" class="btn-primary" style="padding: 10px 25px; background: #38bdf8; color: #020617; border: none; font-weight: bold; border-radius: 6px; cursor: pointer;">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
