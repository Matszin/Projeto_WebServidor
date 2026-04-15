<?php
session_start();

ini_set('display_errors', 1); 
error_reporting(E_ALL);

$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

/* =========================
   🔹 AÇÕES (LOGIN / REGISTER / LOGOUT)
========================= */

// LOGIN
if ($action === 'login') {

    $type = $_POST['type'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password) || empty($type)) {
        header("Location: /public/index.php?error=campos");
        exit;
    }

    // usuários cadastrados (session)
    if (isset($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if (
                $user['email'] === $email &&
                $user['password'] === $password &&
                $user['type'] === $type
            ) {
                $_SESSION['user'] = $email;
                $_SESSION['type'] = $type;

                header("Location: /public/index.php?page=home");
                exit;
            }
        }
    }

    // fallback (Auth.php)
    require_once __DIR__ . '/../app/models/Auth.php';

    if (Auth::login($type, $email, $password)) {

        $_SESSION['user'] = $email;
        $_SESSION['type'] = $type;

        header("Location: /public/index.php?page=home");
        exit;
    }

    header("Location: /public/index.php?error=login");
    exit;
}


// REGISTER
if ($action === 'register') {

    $type = $_POST['type'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    if (empty($email) || empty($password) || empty($confirm) || empty($type)) {
        header("Location: /public/index.php?page=register&error=campos");
        exit;
    }

    if ($password !== $confirm) {
        header("Location: /public/index.php?page=register&error=senha");
        exit;
    }

    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            header("Location: /public/index.php?page=register&error=email");
            exit;
        }
    }

    $_SESSION['users'][] = [
        'email' => $email,
        'password' => $password,
        'type' => $type
    ];

    header("Location: /public/index.php?success=1");
    exit;
}


// LOGOUT
if ($action === 'logout') {
    unset($_SESSION['user']);
    unset($_SESSION['type']);

    header("Location: /public/index.php");
    exit;
}


/* =========================
   🔒 PROTEÇÃO
========================= */

if (!isset($_SESSION['user'])) {

    if ($page !== 'register') {
        require __DIR__ . '/../app/views/auth/login.php';
        exit;
    }
}


/* =========================
   📄 ROTAS
========================= */

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

    case 'register':
        require_once $base_path . 'auth/register.php';
        break;
}