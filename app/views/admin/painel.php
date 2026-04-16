<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['type'] !== 'admin') {
    header("Location: /app/views/auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/UserModel.php';

$userModel = new UserModel();

$users  = $userModel->getByRole('user');
$admins = $userModel->getByRole('admin');

require_once __DIR__ . '/../partials/header.php'; 
?>

<div class="layout">
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <main class="content">   

        <header class="content-header">
            <h1>Painel de Controle Administrativo</h1>
            <p>Gerencie os níveis de acesso e usuários da plataforma.</p>
        </header>

        <div class="admin-columns-container">
            
            <!--lista/coluna de usuarios-->
            <div class="admin-column">
                <h2>
                    Usuários Comuns 
                    <span class="badge-count"><?= count($users) ?></span>
                </h2>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['nome'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td class="actions-cell">
                                <!--torna o usuario em adm -->
                               <a href="/index.php?action=change-role&id=<?= $u['id'] ?>&role=admin" 
                                class="btn-edit-table" title="Tornar Admin">💎</a>
                                
                                <!--exclui usuario -->
                                <a href="/index.php?action=delete-user&id=<?= $u['id'] ?>" 
                                class="btn-delete-table" title="Excluir"
                                onclick="return confirm('Deseja excluir este usuário?')">❌</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!--lista/coluna de adms-->
            <div class="admin-column">
                <h2>
                    Administradores 
                    <span class="badge-count"><?= count($admins) ?></span>
                </h2>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $a): ?>
                        <tr>
                            <td><?= $a['nome'] ?></td>
                            <td><?= $a['email'] ?></td>
                            <td class="actions-cell">
                                <!-- tira o privilégio de adm-->
                                <a href="/index.php?action=change-role&id=<?= $a['id'] ?>&role=user" 
                                class="btn-edit-table" title="Remover Admin"> 🗑️ </a>
                                
                                <!--deleta o adm-->
                                <a href="/index.php?action=delete-user&id=<?= $a['id'] ?>" 
                                class="btn-delete-table" title="Excluir"
                                onclick="return confirm('Deseja excluir este administrador?')">❌</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>