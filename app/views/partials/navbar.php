<div class="sidebar">
    <h2 class="logo">EventHub</h2>
    <ul>
        <li><a href="/home">Explorar Eventos</a></li>

        <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'admin'): ?>
            <li><a href="/eventos/gerenciar">Gerenciar Eventos</a></li>
            <li><a href="/eventos/criar">Criar Eventos</a></li>
            <li><a href="/admin">Painel Admin</a></li>
        <?php endif; ?>

        <li><a href="/inscricoes">Eventos Inscritos</a></li>
        <li><a href="/perfil">Meu Perfil</a></li>
        <li><a href="/logout">Sair</a></li>
    </ul>
</div>
