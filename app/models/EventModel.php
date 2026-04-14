<?php
// app/models/EventModel.php

class EventModel {

    public function __construct() {
        // 1. Garante que a sessão está ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Se a lista de eventos não existir na sessão, cria ela com os dados padrão
        if (!isset($_SESSION['eventos_mock'])) {
            $_SESSION['eventos_mock'] = [
                1 => [
                    'id' => 1, 'titulo' => 'Workshop de PHP Moderno', 'data' => '2026-05-15T14:00',
                    'tipo' => 'academico', 'local' => 'Auditório Central',
                    'descricao' => 'Aprenda as melhores práticas de PHP.'
                ],
                2 => [
                    'id' => 2, 'titulo' => 'Hackathon EventHub', 'data' => '2026-06-20T09:00',
                    'tipo' => 'corporativo', 'local' => 'Laboratório 04',
                    'descricao' => '24 horas de código e muita pizza!'
                ]
            ];
        }
    }

    // LISTAR TODOS (Usado no Explorar Eventos)
    public function all() {
        return $_SESSION['eventos_mock'];
    }

    // BUSCAR UM (Usado no Editar Eventos)
    public function find($id) {
        return $_SESSION['eventos_mock'][$id] ?? null;
    }

    // SALVAR NOVO (Usado no Criar Eventos)
    public function save($dados) {
        // Gera um ID novo baseado no maior ID existente + 1
        $novo_id = count($_SESSION['eventos_mock']) > 0 ? max(array_keys($_SESSION['eventos_mock'])) + 1 : 1;
        
        $dados['id'] = $novo_id;
        
        // SALVA NA SESSÃO
        $_SESSION['eventos_mock'][$novo_id] = $dados;
        return true;
    }

    // ATUALIZAR EXISTENTE (Usado no Editar Eventos)
    public function update($id, $dados) {
        if (isset($_SESSION['eventos_mock'][$id])) {
            $dados['id'] = $id; // Garante que o ID não mude
            $_SESSION['eventos_mock'][$id] = array_merge($_SESSION['eventos_mock'][$id], $dados);
            return true;
        }
        return false;
    }
}
