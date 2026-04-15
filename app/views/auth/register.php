<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../partials/header.php';
?>

<div class="login-container">
    <div class="login-box">

        <h1 class="logo-login">EventHub</h1>
        <h2>Cadastro</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-msg">
                <?php
                    if ($_GET['error'] === 'senha') {
                        echo "As senhas não coincidem!";
                    } elseif ($_GET['error'] === 'email') {
                        echo "Este email já está cadastrado!";
                    } elseif ($_GET['error'] === 'campos') {
                        echo "Preencha todos os campos!";
                    } else {
                        echo "Erro ao cadastrar!";
                    }
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-msg">Cadastro realizado com sucesso!</div>
        <?php endif; ?>

        <form method="POST" action="/public/index.php?action=register">

            <label>Tipo de Conta</label>
            <select name="type" required>
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select>

            <label>Email</label>
            <input type="text" name="email" required>

            <label>Senha</label>
            <input type="password" name="password" required>

            <label>Confirmar Senha</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Cadastrar</button>
        </form>

        <p style="text-align:center; margin-top:10px;">
            Já tem conta? <a href="/app/views/auth/login.php">Login</a>
        </p>

    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>