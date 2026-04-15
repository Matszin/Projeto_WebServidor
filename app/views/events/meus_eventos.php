<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['type'] !== 'admin') {
    header("Location: /app/views/auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/EventModel.php';
$model = new EventModel();
$eventos = $model->all(); 

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">
        <header class="content-header">
            <h1>Meus Eventos</h1>
            <p>Gerencie e acompanhe o desempenho dos seus eventos publicados.</p>
        </header>

        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Título do Evento</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($eventos)): ?>
                        <tr>
                            <!-- Agora usando a classe CSS em vez de style inline -->
                            <td colspan="4" class="table-empty-message">
                                Você ainda não criou nenhum evento.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($eventos as $evento): ?>
                            <tr>
                                <td><strong><?= $evento['titulo'] ?></strong></td>
                                <td><?= date('d/m/Y', strtotime($evento['data'])) ?></td>
                                <td><?= $evento['local'] ?></td>
                                <td class="actions-cell">
                                    <a href="/index.php?page=editar-evento&id=<?= $evento['id'] ?>" class="btn-edit-table">Editar</a>
                                    <span class="btn-delete-table" onclick="alert('A exclusão será implementada com banco de dados no Trabalho 2!')">Excluir</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
