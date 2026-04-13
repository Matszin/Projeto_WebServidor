
<?php require_once __DIR__ . '/../partials/header.php';?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php';?>
        <div class="content">
            <main class="content">
                <h1>Criar Eventos</h1>
                <p>Crie seus eventos aqui:</p>
                <div class="conteiner-form">
                    <form action="/app/controllers/event_controller.php?action=store" method="POST" enctype="multipart/form-data">
                    
                        <!--Titulo do formulário-->
                        <div class="form-group">
                            <label for="titulo">Título do Evento</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Ex:Futebol as 19:00" required>
                        </div>

                        <!-- Linha com Data e Tipo (Lado a Lado) -->
                        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
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

                        <!-- Local ou Link -->
                        <div class="form-group">
                            <label for="local">Local ou Link (se online)</label>
                            <input type="text" id="local" name="local" placeholder="Ex: Auditório Central ou URL do Meet" required>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <label for="descricao">Descrição Completa</label>
                            <textarea id="descricao" name="descricao" rows="4" placeholder="Detalhes do evento, palestrantes, etc..." required></textarea>
                        </div>

                        <!-- Banner -->
                        <div class="form-group">
                            <label for="banner">Imagem do Banner</label>
                            <input type="file" id="banner" name="banner" accept="image/*">
                        </div>

                        <!--Botões-->
                        <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                            <button type="reset" class="btn-secondary" style="padding: 10px 20px; cursor: pointer;">Limpar</button>
                            <button type="submit" class="btn-primary" style="padding: 10px 20px; background: #38bdf8; color: #020617; border: none; font-weight: bold; cursor: pointer;">Publicar Evento</button>
                        </div>
                </form>

                </div>
                    <form action="/app/controllers/event_controller" method="POST">

                    </form>
            </main>
        </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php';