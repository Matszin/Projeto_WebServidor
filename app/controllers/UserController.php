<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    // Funcao para excluir usuario
    public function destroy() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        preg_match('#^/admin/usuarios/(\d+)/deletar$#', $uri, $m);
        $id = $m[1] ?? null;

        if ($id) {
            $this->model->delete($id);
        }
        header("Location: /admin");
        exit;
    }

    // Funcao para mudar o cargo
    public function changeRole() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        preg_match('#^/admin/usuarios/(\d+)/cargo$#', $uri, $m);
        $id   = $m[1] ?? null;
        $role = $_GET['role'] ?? 'user';

        if ($id) {
            $this->model->updateRole($id, $role);
        }
        header("Location: /admin");
        exit;
    }
}
