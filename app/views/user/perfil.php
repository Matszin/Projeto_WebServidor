<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../partials/header.php';

$email = $_SESSION['user'] ?? '';
$type = $_SESSION['type'] ?? '';
?>

<div class="layout">

    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="content">
        <main class="content">

            <h1>Meu Perfil</h1>
            <p>Visualize e edite suas informações</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="error-msg">
                    <?php
                         if ($_GET['error'] === 'senha') echo "As novas senhas não coincidem!";
                        elseif ($_GET['error'] === 'atual') echo "Senha atual incorreta!";
                        else echo "Preencha todos os campos!";
                    ?>
                </div>
            <?php endif; ?>

            <div class="content-form">

            <h2 class="form-title">Editar Senha</h2>

            <form action="/public/index.php?action=update-profile" method="POST">

                <!-- INFO -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="<?= htmlspecialchars($email) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Tipo de Conta</label>
                    <input type="text" value="<?= $type === 'admin' ? 'Administrador' : 'Usuário' ?>" disabled>
                </div>

                <!-- SENHAS -->
                <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" name="current_password" placeholder="Digite sua senha atual" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input type="password" name="new_password" placeholder="Digite nova senha" required>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <input type="password" name="confirm_password" placeholder="Confirme a nova senha" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Salvar Alterações</button>
                </div>

                </form>

            </div>

        </main>
    </div>

</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>