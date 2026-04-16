<?php

class UserModel {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Se não existirem usuários na sessão, criamos os iniciais
        if (!isset($_SESSION['usuarios'])) {
            $_SESSION['usuarios'] = [
                1 => ['id' => 1, 'nome' => 'João Silva', 'email' => 'user@test.com', 'role' => 'user'],
                2 => ['id' => 2, 'nome' => 'Maria Souza', 'email' => 'maria@test.com', 'role' => 'user'],
                3 => ['id' => 3, 'nome' => 'Mateus Admin', 'email' => 'admin@test.com', 'role' => 'admin'],
                4 => ['id' => 4, 'nome' => 'Vitor Admin', 'email' => 'vitor@admin.com', 'role' => 'admin'],
            ];
        }
    }

    // Retorna todos os usuários
    public function all() {
        return $_SESSION['usuarios'];
    }

    // Filtra usuários por tipo (user ou admin)
    public function getByRole($role) {
        return array_filter($_SESSION['usuarios'], fn($u) => $u['role'] === $role);
    }

    // Deleta um usuário da sessão
    public function delete($id) {
        if (isset($_SESSION['usuarios'][$id])) {
            unset($_SESSION['usuarios'][$id]);
            return true;
        }
        return false;
    }

    // Promove ou remove privilégios de Admin
    public function updateRole($id, $newRole) {
        if (isset($_SESSION['usuarios'][$id])) {
            $_SESSION['usuarios'][$id]['role'] = $newRole;
            return true;
        }
        return false;
    }
}
