<?php
session_start(); 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

$page = $_GET['page'] ?? 'home';

$base_path = __DIR__ . '/../app/views/'; //define o caminho de base

// 3. Sistema de Roteamento
switch ($page) {
    case 'criar-evento':
        require_once $base_path . 'events/criar_eventos.php';
        break;
        
        case 'editar-evento':
        require_once $base_path . 'events/editar_eventos.php';
        break;

    case 'eventos':
        require_once $base_path . 'events/listar_eventos.php';
        break;

    case 'meus-eventos':
        require_once $base_path . 'events/meus_eventos.php';
        break;

    case 'admin':
        require_once $base_path . 'admin/painel.php';
        break;

    case 'home':
    default:
        // Carrega o cabeçalho
        require_once $base_path . 'partials/header.php';
        
        // Abre a div do layout e inclui a sidebar
        echo '<div class="layout">';
        require_once $base_path . 'partials/navbar.php';
        
        // Conteúdo da página inicial (dentro do main para o CSS funcionar)
        echo '<main class="content">
                <h1>Bem-vindo ao EventHub</h1>
                <p>Selecione uma opção no menu lateral para começar.</p>
              </main>';
        
        // Fecha a div do layout e carrega o rodapé
        echo '</div>';
        require_once $base_path . 'partials/footer.php';
        break;
}
