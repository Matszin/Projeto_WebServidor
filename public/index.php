<?php
session_start();
if (!isset($_SESSION['user']) && ($_GET['action'] ?? '') !== 'login') {
    require __DIR__ . '/../app/views/auth/login.php';
    exit;
}
ini_set('display_errors', 1); 
error_reporting(E_ALL);

$action = $_GET['action'] ?? '';

if ($action === 'login') {

    $type = $_POST['type'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password) || empty($type)) {
        header("Location: /app/views/auth/login.php?error=1");
        exit;
    }

    require_once __DIR__ . '/../app/models/Auth.php';

if (Auth::login($type, $email, $password)) {

    $_SESSION['user'] = $email;
    $_SESSION['type'] = $type;

    if ($type === 'admin') {
        header("Location: /app/views/admin/painel.php");
    } else {
        header("Location: /app/views/events/listar_eventos.php");
    }
    exit;

} else {
    header("Location: /app/views/auth/login.php?error=1");
    exit;
}

    if (
        isset($users[$type]) &&
        $email === $users[$type]['email'] &&
        $password === $users[$type]['password']
    ) {
        $_SESSION['user'] = $email;
        $_SESSION['type'] = $type;

        if ($type === 'admin') {
            header("Location: /app/views/admin/painel.php");
        } else {
            header("Location: /app/views/events/listar_eventos.php");
        }
        exit;
    } else {
        header("Location: /app/views/auth/login.php?error=1");
        exit;
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: /app/views/auth/login.php");
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

    case 'meus-eventos':
        require_once $base_path . 'events/meus_eventos.php';
        break;

    case 'admin':
        require_once $base_path . 'admin/painel.php';
        break;

    case 'detalhes-evento':
        require_once $base_path . 'events/detalhes_evento.php';
        break;
}
