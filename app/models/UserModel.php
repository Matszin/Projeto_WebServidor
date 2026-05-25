<?php

require_once __DIR__ . '/../config/database.php';

class UserModel {

    private $pdo;

    public function __construct() {

        $this->pdo = Database::connect();
    }

    // Criar usuário
    public function create($nome, $email, $senha, $role) {

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("
         INSERT INTO users (nome, email, senha, role)
        VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $nome,
            $email,
            $hash,
            $role
        ]);
    }

    // Buscar por email
    public function findByEmail($email) {

        $stmt = $this->pdo->prepare("
            SELECT * FROM users
            WHERE email = ?
            LIMIT 1
        ");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos
    public function all() {

        $stmt = $this->pdo->query("
            SELECT id, nome, email, role
            FROM users
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por role
    public function getByRole($role) {

    $stmt = $this->pdo->prepare("
        SELECT *
        FROM users
        WHERE role = ?
        ORDER BY nome ASC
    ");

    $stmt->execute([$role]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Deletar
    public function delete($id) {

    $stmt = $this->pdo->prepare("
        DELETE FROM users
        WHERE id = ?
    ");

    return $stmt->execute([$id]);
    }

    // Trocar cargo
    public function updateRole($id, $newRole) {

    $stmt = $this->pdo->prepare("
        UPDATE users
        SET role = ?
        WHERE id = ?
    ");

    return $stmt->execute([
        $newRole,
        $id
    ]);
    }

    public function findById($id) {

    $stmt = $this->pdo->prepare("
        SELECT *
        FROM users
        WHERE id = ?
        LIMIT 1
    ");

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $newPassword) {

    $hash = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $this->pdo->prepare("
        UPDATE users
        SET senha = ?
        WHERE id = ?
    ");

    return $stmt->execute([
        $hash,
        $id
    ]);
    }
}
