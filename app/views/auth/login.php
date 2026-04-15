<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../partials/header.php';
?>

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

.login-box {
    width: 400px;
    padding: 30px;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 20px;
    color: #555;
}

.login-box input,
.login-box select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
}

.login-box button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
}

.error-msg {
    background: #ffdddd;
    color: #a00;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
}
</style>

<div class="login-container">
    <div class="login-box">

        <h1 class="logo-login">EventHub</h1>
        <h2>Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-msg">
                Email ou senha inválidos!
            </div>
        <?php endif; ?>

        <form method="POST" action="/public/index.php?action=login">

            <label>Tipo de Login</label>
            <select name="type" required>
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select>

            <br>

            <label>Email</label>
            <input type="text" name="email" placeholder="Digite seu email" required>

            <br>

            <label>Senha</label>
            <input type="password" name="password" placeholder="Digite sua senha" required>

            <button type="submit">Entrar</button>

        </form>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>