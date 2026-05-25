<?php

require_once __DIR__ . '/../config/database.php';

class EventModel {

    private $pdo;

    public function __construct() {

        $this->pdo = Database::connect();
    }

    // lista todos
    public function all() {

        $stmt = $this->pdo->query("
            SELECT *
            FROM eventos
            ORDER BY data ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // busca um evento
    public function find($id) {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM eventos
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // cria evento
    public function save($dados) {

        $stmt = $this->pdo->prepare("
            INSERT INTO eventos
            (titulo, data, tipo, local, descricao)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $dados['titulo'],
            $dados['data'],
            $dados['tipo'],
            $dados['local'],
            $dados['descricao']
        ]);
    }

    // atualiza evento
    public function update($id, $dados) {

        $stmt = $this->pdo->prepare("
            UPDATE eventos
            SET
                titulo = ?,
                data = ?,
                tipo = ?,
                local = ?,
                descricao = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $dados['titulo'],
            $dados['data'],
            $dados['tipo'],
            $dados['local'],
            $dados['descricao'],
            $id
        ]);
    }

    // deleta
    public function delete($id){

        $stmt = $this->pdo->prepare("
            DELETE FROM eventos
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    public function inscreverUsuario($userId, $eventoId) {

    $stmt = $this->pdo->prepare("
        INSERT INTO inscricoes (user_id, evento_id)
        VALUES (?, ?)
    ");

    return $stmt->execute([
        $userId,
        $eventoId
    ]);
    }

    public function cancelarInscricao($userId, $eventoId) {

    $stmt = $this->pdo->prepare("
        DELETE FROM inscricoes
        WHERE user_id = ?
        AND evento_id = ?
    ");

    return $stmt->execute([
        $userId,
        $eventoId
    ]);
    }

    public function eventosInscritos($userId) {

    $stmt = $this->pdo->prepare("
        SELECT eventos.*
        FROM inscricoes
        JOIN eventos
        ON inscricoes.evento_id = eventos.id
        WHERE inscricoes.user_id = ?
    ");

    $stmt->execute([$userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}