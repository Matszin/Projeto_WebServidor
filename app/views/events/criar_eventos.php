<?php
if (isset($_GET['action']) && $_GET['action'] === 'store') {
   
    require_once __DIR__ . '/../../controllers/EventController.php';
    $controller = new EventController();
    $controller->store();
    exit;
}
?>
<?php require_once __DIR__ . '/../partials/header.php';?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php';?>
        <div class="content">
            <main class="content">
                <h1>Criar Eventos</h1>
                <p>Crie seus eventos aqui:</p>
                <div class="content-form">
                  <!-- O formulário envia para o index, passando a página e a ação -->
                    <form action="/index.php?page=criar-evento&action=store" method="POST" enctype="multipart/form-data">

                        <!--Titulo do formulário-->
                        <div class="form-group">
                            <label for="titulo">Título do Evento</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Ex:Futebol as 19:00" required>
                        </div>

                        <!-- Data e hr-->
                        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label for="data_evento">Data e Hora</label>
                                <input type="datetime-local" id="data_evento" name="data_evento" required>
                            </div>
                            
                            <!--Tipo de evento-->
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

                        <!-- Local-->
                        <div class="form-group">
                            <label for="local">Local ou Link (se online)</label>
                            <input type="text" id="local" name="local" placeholder="Ex: Auditório Central ou URL do Meet" required>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <label for="descricao">Descrição Completa</label>
                            <textarea id="descricao" name="descricao" rows="4" placeholder="Detalhes do evento, palestrantes, etc..." required></textarea>
                        </div>

                        <!--Imgem -->
                        <div class="form-group">
                            <label for="banner">Imagem do Banner</label>
                            <input type="file" id="banner" name="banner" accept="image/*">
                        </div>

                        <!--Botões-->
                       <div class="form-actions">
                            <button type="reset" class="btn-secondary">Limpar</button>
                            <button type="submit" class="btn-primary">Publicar Evento</button>
                        </div>

                </form>

                </div>
             </main>
        </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php';