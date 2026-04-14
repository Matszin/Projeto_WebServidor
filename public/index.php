<?php
session_start(); 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

    if (isset($_GET['action'])) {
        require_once __DIR__ . '/../app/controllers/EventController.php';
        $controller = new EventController();
        
        if ($_GET['action'] === 'store') {
            $controller->store();
            exit; // Para a execução aqui para não duplicar o evento
        } elseif ($_GET['action'] === 'update') {
            $controller->update();
            exit;
        }
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

            case 'meus-eventos':
                require_once $base_path . 'events/meus_eventos.php';
                break;

            case 'admin':
                require_once $base_path . 'admin/painel.php';
                break;
            
}
