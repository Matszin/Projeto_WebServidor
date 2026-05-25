<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['type'] !== 'admin') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../partials/header.php';
?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="content">
        <main class="content">
            <h1>Criar Eventos</h1>
            <p>Crie seus eventos aqui:</p>
            <div class="content-form">
                <form action="/eventos/criar" method="POST" enctype="multipart/form-data">

                    <!-- titulo -->
                    <div class="form-group">
                        <label for="titulo">Título do Evento</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Ex: Futebol as 19:00" required>
                    </div>

                    <!-- Data e hora / Tipo -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="data_evento">Data e Hora</label>
                            <input type="datetime-local" id="data_evento" name="data_evento" required>
                        </div>

                        <div class="form-group">
                            <label for="tipo_evento">Tipo de Evento</label>
                            <select id="tipo_evento" name="tipo_evento" required>
                                <option value="">Selecione...</option>
                                <option value="corporativo">Corporativo</option>
                                <option value="academico">Acadêmico</option>
                                <option value="cultural">Cultural</option>
                                <option value="esportivo">Esportivo</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                    </div>

                    <!-- local -->
                    <div class="form-group">
                        <label for="local">Local ou Link (se online)</label>
                        <input type="text" id="local" name="local" placeholder="Ex: Auditório Central ou URL do Meet" required>
                    </div>

                    <!-- descrição -->
                    <div class="form-group">
                        <label for="descricao">Descrição Completa</label>
                        <textarea id="descricao" name="descricao" rows="4" placeholder="Detalhes do evento, palestrantes, etc..." required></textarea>
                    </div>

                    <!-- botões -->
                    <div class="form-actions">
                        <button type="reset" class="btn-secondary">Limpar</button>
                        <button type="submit" class="btn-primary">Publicar Evento</button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
