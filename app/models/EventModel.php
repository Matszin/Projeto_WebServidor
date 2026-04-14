<?php
// app/models/EventModel.php

class EventModel {

    public function __construct() {
        // verifica se a session está ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // define uma lista de eventos base
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

    //lista todos os eventos
    public function all() {
        return $_SESSION['eventos_mock'];
    }

    //busca todos os eventos
    public function find($id) {
        return $_SESSION['eventos_mock'][$id] ?? null;
    }

   //salva o evento
    public function save($dados) {
        //gera um id 
        $novo_id = count($_SESSION['eventos_mock']) > 0 ? max(array_keys($_SESSION['eventos_mock'])) + 1 : 1;
        
        $dados['id'] = $novo_id;
        
        //salva o evento na session
        $_SESSION['eventos_mock'][$novo_id] = $dados;
        return true;
    }

    //atualiza o evento
    public function update($id, $dados) {
        if (isset($_SESSION['eventos_mock'][$id])) {
            $dados['id'] = $id;
            $_SESSION['eventos_mock'][$id] = array_merge($_SESSION['eventos_mock'][$id], $dados);
            return true;
        }
        return false;
    }
}
