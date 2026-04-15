<?php
session_start();

// --- CONFIGURAÇÕES DE ERRO ---
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// --- IMPORTAÇÕES ---
require_once __DIR__ . '/../app/models/Auth.php';

// --- 1. PROCESSAMENTO DE AÇÕES (LOGIN / LOGOUT / EVENTOS) ---
$action = $_GET['action'] ?? '';

if ($action !== '') {
    // Ação de Login (Vitor)
    if ($action === 'login') {
        $type     = $_POST['type'] ?? '';
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (Auth::login($type, $email, $password)) {
            $_SESSION['user'] = $email;
            $_SESSION['type'] = $type;
            // REGRA: Todo mundo vai para a Home após logar
            header("Location: /index.php?page=home");
        } else {
            header("Location: /index.php?page=login&error=1");
        }
        exit;
    }
    
    // Ação de Logout
    elseif ($action === 'logout') {
        session_destroy();
        header("Location: /index.php?page=login");
        exit;
    }

    // Ações de Eventos (Mateus) - Só processa se estiver logado
    elseif (in_array($action, ['store', 'update', 'destroy']) && isset($_SESSION['user'])) {
        require_once __DIR__ . '/../app/controllers/EventController.php';
        $controller = new EventController();
        
        switch ($action) {
            case 'store':   $controller->store();   break;
            case 'update':  $controller->update();  break;
            case 'destroy': $controller->destroy(); break;
        }
        exit;
    }
}

// --- 2. CONTROLE DE ACESSO (TRAVA DE LOGIN) ---
$page = $_GET['page'] ?? 'home';
$is_logged = isset($_SESSION['user']);
$user_type = $_SESSION['type'] ?? 'guest';

// Páginas Públicas
$public_pages = ['login', 'cadastro'];

// Se não logado e página não pública -> Login
if (!$is_logged && !in_array($page, $public_pages)) {
    header("Location: /index.php?page=login");
    exit;
}

// Se logado e tentar acessar login/cadastro -> Home
if ($is_logged && in_array($page, $public_pages)) {
    header("Location: /index.php?page=home");
    exit;
}

// --- 3. SWITCH DE VIEWS ---
$base_path = __DIR__ . '/../app/views/';

switch ($page) {
    case 'home':
        require_once $base_path . 'events/listar_eventos.php';
        break;
    case 'detalhes-evento':
        require_once $base_path . 'events/detalhes_evento.php';
        break;
    case 'criar-evento':
        require_once $base_path . 'events/criar_eventos.php';
        break;
    case 'editar-evento':
        require_once $base_path . 'events/editar_eventos.php';
        break;
    case 'meus-eventos':
    case 'gerenciar-eventos': // Unificando nomes se necessário
        require_once $base_path . 'events/gerenciar_eventos.php';
        break;
    case 'admin':
        require_once $base_path . 'admin/painel.php';
        break;
    case 'login':
        require_once $base_path . 'auth/login.php';
        break;
    case 'cadastro':
        require_once $base_path . 'auth/cadastro.php';
        break;
    case 'perfil':
        require_once $base_path . 'user/perfil.php';
        break;
    default:
        header("Location: /index.php?page=home");
        break;
}
