<div class="sidebar">
    <h2 class="logo">EventHub</h2>
    <ul>
        <li><a href="/index.php?page=home">Explorar Eventos</a></li>

        <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
            <li><a href="/index.php?page=gerenciar-eventos">Gerenciar Eventos</a></li>
            <li><a href="/index.php?page=criar-evento">Criar Eventos</a></li>     
            <li><a href="/index.php?page=admin">Painel Admin</a></li>
        <?php endif; ?>

        <li><a href="/index.php?page=perfil">Meu Perfil</a></li>
        <li><a href="/public/index.php?action=logout">Sair</a></li>
    </ul>
</div>
