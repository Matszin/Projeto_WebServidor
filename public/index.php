<?php
session_start(); 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

    //processa açoes
    if (isset($_GET['action'])) {
    require_once __DIR__ . '/../app/controllers/EventController.php';
    $controller = new EventController();
    
    $action = $_GET['action'];

    switch ($action) {
        case 'store':
            $controller->store();
            break;

        case 'update':
            $controller->update();
            break;

        case 'destroy':
            $controller->destroy();
            break;

        default:
            //se a ação não existir
            header("Location: /index.php?page=home");
            break;
    }
    exit; 
}

        $page = $_GET['page'] ?? 'home';
        $base_path = __DIR__ . '/../app/views/';

    switch ($page) {
            case 'criar-evento':
                require_once $base_path . 'events/criar_eventos.php';
                break;
            
            case 'editar-evento':
                require_once $base_path . 'events/editar_eventos.php';
                break;

            case 'home':
                require_once $base_path . 'events/listar_eventos.php';
                break;

            case 'gerenciar-eventos':
                require_once $base_path . 'events/gerenciar_eventos.php';
                break;

            case 'admin':
                require_once $base_path . 'admin/painel.php';
                break;
            case 'detalhes-evento':
                require_once $base_path . 'events/detalhes_evento.php';
                break;

            
}
