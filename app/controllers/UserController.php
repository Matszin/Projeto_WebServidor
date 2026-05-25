<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    //funcao para excluir usuario
    public function destroy() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header("Location: /index.php?page=admin");
        exit;
    }

    //funcao para mudar o cargo
    public function changeRole() {
        $id = $_GET['id'] ?? null;
        $role = $_GET['role'] ?? 'user';
        
        if ($id) {
            $this->model->updateRole($id, $role);
        }
        header("Location: /index.php?page=admin");
        exit;
    }
}
