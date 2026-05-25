<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

session_set_cookie_params([
    'httponly' => true,
    'secure'   => false,
    'samesite' => 'Strict'
]);
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/models/Auth.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

$is_logged   = isset($_SESSION['user']);
$public_uris = ['/login', '/cadastro'];


// Login
if ($uri === '/login' && $method === 'POST') {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        header("Location: /login?error=campos");
        exit;
    }

    if (Auth::login($email, $password)) {
        header("Location: /home");
        exit;
    }

    header("Location: /login?error=1");
    exit;
}

// Cadastro
if ($uri === '/cadastro' && $method === 'POST') {

    require_once __DIR__ . '/../app/models/UserModel.php';

    $type     = $_POST['type'] ?? '';
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm_password'] ?? '');

    if (empty($nome) || empty($email) || empty($password) || empty($confirm)) {
        header("Location: /cadastro?error=campos");
        exit;
    }

    if ($password !== $confirm) {
        header("Location: /cadastro?error=senha");
        exit;
    }

    $userModel = new UserModel();

    if ($userModel->findByEmail($email)) {
        header("Location: /cadastro?error=email");
        exit;
    }

    $userModel->create($nome, $email, $password, $type);
    header("Location: /login?success=1");
    exit;
}

// Logout
if ($uri === '/logout') {
    unset($_SESSION['user'], $_SESSION['type']);
    header("Location: /login");
    exit;
}

// Deletar conta
if ($uri === '/conta/deletar' && $is_logged) {

    require_once __DIR__ . '/../app/models/UserModel.php';
    $userModel = new UserModel();
    $user = $userModel->findByEmail($_SESSION['user']);

    if ($user) {
        $userModel->delete($user['id']);
    }

    session_destroy();
    header("Location: /login");
    exit;
}

// Atualizar perfil
if ($uri === '/perfil/atualizar' && $method === 'POST' && $is_logged) {

    require_once __DIR__ . '/../app/models/UserModel.php';

    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$current || !$new || !$confirm) {
        header("Location: /perfil?error=campos");
        exit;
    }

    if ($new !== $confirm) {
        header("Location: /perfil?error=senha");
        exit;
    }

    $userModel = new UserModel();
    $user = $userModel->findByEmail($_SESSION['user']);

    if (!$user || !password_verify($current, $user['senha'])) {
        header("Location: /perfil?error=atual");
        exit;
    }

    $userModel->updatePassword($user['id'], $new);
    header("Location: /perfil?success=1");
    exit;
}

// Inscrever em evento  — /eventos/{id}/inscrever
if (preg_match('#^/eventos/(\d+)/inscrever$#', $uri, $m) && $is_logged) {

    require_once __DIR__ . '/../app/models/EventModel.php';
    require_once __DIR__ . '/../app/models/UserModel.php';

    $eventoId = $m[1];
    $userModel = new UserModel();
    $user = $userModel->findByEmail($_SESSION['user']);

    if ($user) {
        (new EventModel())->inscreverUsuario($user['id'], $eventoId);
    }

    header("Location: /inscricoes");
    exit;
}

// Cancelar inscrição  — /eventos/{id}/cancelar
if (preg_match('#^/eventos/(\d+)/cancelar$#', $uri, $m) && $is_logged) {

    require_once __DIR__ . '/../app/models/EventModel.php';
    require_once __DIR__ . '/../app/models/UserModel.php';

    $eventoId = $m[1];
    $userModel = new UserModel();
    $user = $userModel->findByEmail($_SESSION['user']);

    if ($user) {
        (new EventModel())->cancelarInscricao($user['id'], $eventoId);
    }

    header("Location: /inscricoes");
    exit;
}

// Criar evento (POST)  — /eventos/criar
if ($uri === '/eventos/criar' && $method === 'POST' && $is_logged) {
    require_once __DIR__ . '/../app/controllers/EventController.php';
    (new EventController())->store();
    exit;
}

// Atualizar evento (POST)  — /eventos/{id}/editar
if (preg_match('#^/eventos/(\d+)/editar$#', $uri, $m) && $method === 'POST' && $is_logged) {
    require_once __DIR__ . '/../app/controllers/EventController.php';
    (new EventController())->update();
    exit;
}

// Deletar evento  — /eventos/{id}/deletar
if (preg_match('#^/eventos/(\d+)/deletar$#', $uri, $m) && $is_logged) {
    require_once __DIR__ . '/../app/controllers/EventController.php';
    (new EventController())->destroy();
    exit;
}

// Admin: deletar usuário  — /admin/usuarios/{id}/deletar
if (preg_match('#^/admin/usuarios/(\d+)/deletar$#', $uri) && $is_logged && ($_SESSION['type'] ?? '') === 'admin') {
    require_once __DIR__ . '/../app/controllers/UserController.php';
    (new UserController())->destroy();
    exit;
}

// Admin: trocar cargo  — /admin/usuarios/{id}/cargo
if (preg_match('#^/admin/usuarios/(\d+)/cargo$#', $uri) && $is_logged && ($_SESSION['type'] ?? '') === 'admin') {
    require_once __DIR__ . '/../app/controllers/UserController.php';
    (new UserController())->changeRole();
    exit;
}

// ---- CONTROLE DE ACESSO -------------------------------------

if (!$is_logged && !in_array($uri, $public_uris)) {
    header("Location: /login");
    exit;
}

if ($is_logged && in_array($uri, $public_uris)) {
    header("Location: /home");
    exit;
}

// ---- PÁGINAS (GET) ------------------------------------------

$base = __DIR__ . '/../app/views/';

// /eventos/{id}/detalhes  — antes do catch-all de /eventos/*
if (preg_match('#^/eventos/(\d+)/detalhes$#', $uri)) {
    require_once $base . 'events/detalhes_evento.php';
    exit;
}

// /eventos/{id}/editar (GET — exibe formulário)
if (preg_match('#^/eventos/(\d+)/editar$#', $uri)) {
    require_once $base . 'events/editar_eventos.php';
    exit;
}

switch ($uri) {
    case '/home':
        require_once $base . 'events/listar_eventos.php';
        break;

    case '/eventos/criar':
        require_once $base . 'events/criar_eventos.php';
        break;

    case '/eventos/gerenciar':
    case '/meus-eventos':
        require_once $base . 'events/gerenciar_eventos.php';
        break;

    case '/inscricoes':
        require_once $base . 'events/inscricoes.php';
        break;

    case '/admin':
        require_once $base . 'admin/painel.php';
        break;

    case '/login':
        require_once $base . 'auth/login.php';
        break;

    case '/cadastro':
        require_once $base . 'auth/register.php';
        break;

    case '/perfil':
        require_once $base . 'user/perfil.php';
        break;

    default:
        header("Location: /home");
        break;
}
