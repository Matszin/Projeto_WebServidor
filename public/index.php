<?php
session_start();

//config de erro
ini_set('display_errors', 1); 
error_reporting(E_ALL);


require_once __DIR__ . '/../app/models/Auth.php';

//pega uma ação
$action = $_GET['action'] ?? '';

//login
if ($action === 'login') {

    $type     = $_POST['type'] ?? '';
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password) || empty($type)) {
        header("Location: /public/index.php?page=login&error=campos");
        exit;
    }

    //usuários cadastrados via session
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

    //se o login falhar
    if (Auth::login($type, $email, $password)) {
        $_SESSION['user'] = $email;
        $_SESSION['type'] = $type;

        header("Location: /public/index.php?page=home");
        exit;
    }

    header("Location: /public/index.php?page=login&error=1");
    exit;
}


if ($action === 'register') {

    $type     = $_POST['type'] ?? '';
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm_password'] ?? '');

    if (empty($email) || empty($password) || empty($confirm) || empty($type)) {
        header("Location: /public/index.php?page=cadastro&error=campos");
        exit;
    }

    if ($password !== $confirm) {
        header("Location: /public/index.php?page=cadastro&error=senha");
        exit;
    }

    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            header("Location: /public/index.php?page=cadastro&error=email");
            exit;
        }
    }

    $_SESSION['users'][] = [
        'email' => $email,
        'password' => $password,
        'type' => $type
    ];

    header("Location: /public/index.php?page=login&success=1");
    exit;
}


if ($action === 'logout') {
    unset($_SESSION['user']);
    unset($_SESSION['type']);

    header("Location: /public/index.php?page=login");
    exit;
}

if ($action === 'inscrever') {

    $id = $_GET['id'] ?? '';
    $email = $_SESSION['user'];

    if (!isset($_SESSION['inscricoes'])) {
        $_SESSION['inscricoes'] = [];
    }

    if (!isset($_SESSION['inscricoes'][$email])) {
        $_SESSION['inscricoes'][$email] = [];
    }

    // evita duplicado
    if (!in_array($id, $_SESSION['inscricoes'][$email])) {
        $_SESSION['inscricoes'][$email][] = $id;
    }

    header("Location: /public/index.php?page=inscricoes");
    exit;
}

if ($action === 'update-profile') {

    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($current) || empty($new) || empty($confirm)) {
        header("Location: /public/index.php?page=perfil&error=campos");
        exit;
    }

    if ($new !== $confirm) {
        header("Location: /public/index.php?page=perfil&error=senha");
        exit;
    }

    $userFound = false;

    foreach ($_SESSION['users'] as &$user) {
        if ($user['email'] === $_SESSION['user']) {

            // verifica senha atual
            if ($user['password'] !== $current) {
                header("Location: /public/index.php?page=perfil&error=atual");
                exit;
            }

            // atualiza senha
            $user['password'] = $new;
            $userFound = true;
        }
    }

    if ($userFound) {
        header("Location: /public/index.php?page=perfil&success=1");
    } else {
        header("Location: /public/index.php?page=perfil&error=1");
    }

    exit;
}

// =========================
// 📦 EVENTOS (controller)
// =========================
if (in_array($action, ['store', 'update', 'destroy']) && isset($_SESSION['user'])) {
    require_once __DIR__ . '/../app/controllers/EventController.php';
    $controller = new EventController();

    switch ($action) {
        case 'store':   $controller->store();   break;
        case 'update':  $controller->update();  break;
        case 'destroy': $controller->destroy(); break;
    }
    exit;
}
//troca de usuario para adm 
if (in_array($action, ['delete-user', 'change-role']) && isset($_SESSION['user']) && $_SESSION['type'] === 'admin') {
    require_once __DIR__ . '/../app/controllers/UserController.php';
    $userCtrl = new UserController();
    
    switch ($action) {
        case 'delete-user': $userCtrl->destroy();    break;
        case 'change-role': $userCtrl->changeRole(); break;
    }
    exit;
}

//controle de acessp
$page = $_GET['page'] ?? 'home';
$is_logged = isset($_SESSION['user']);

// paginas publicas
$public_pages = ['login', 'cadastro'];

if (!$is_logged && !in_array($page, $public_pages)) {
    header("Location: /public/index.php?page=login");
    exit;
}

if ($is_logged && in_array($page, $public_pages)) {
    header("Location: /public/index.php?page=home");
    exit;
}


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
    case 'gerenciar-eventos':
        require_once $base_path . 'events/gerenciar_eventos.php';
        break;

    case 'admin':
        require_once $base_path . 'admin/painel.php';
        break;

    case 'inscricoes':
        require_once $base_path . 'events/inscricoes.php';
        break;

    case 'login':
        require_once $base_path . 'auth/login.php';
        break;

    case 'cadastro':
        require_once $base_path . 'auth/register.php';
        break;

    case 'perfil':
        require_once $base_path . 'user/perfil.php';
        break;

    default:
        header("Location: /public/index.php?page=home");
        break;
}