<?php

class EventModel {

    public function __construct() {
        // verifica se a session está ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // define uma lista de eventos base
        if (!isset($_SESSION['eventos'])) {
            $_SESSION['eventos'] = [
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
        return $_SESSION['eventos'];
    }

    //busca todos os eventos
    public function find($id) {
        return $_SESSION['eventos'][$id] ?? null;
    }

   //salva o evento
    public function save($dados) {
        //gera um id 
        $novo_id = count($_SESSION['eventos']) > 0 ? max(array_keys($_SESSION['eventos'])) + 1 : 1;
        
        $dados['id'] = $novo_id;
        
        //salva o evento na session
        $_SESSION['eventos'][$novo_id] = $dados;
        return true;
    }

    //atualiza o evento na session
    public function update($id, $dados) {
        if (isset($_SESSION['eventos'][$id])) {
            $dados['id'] = $id;
            $_SESSION['eventos'][$id] = array_merge($_SESSION['eventos'][$id], $dados);
            return true;
        }
        return false;
    }

    //deleta o evento na session
    public function delete($id){
        if(isset($_SESSION['eventos']) && isset($_SESSION['eventos'][$id])){
            unset($_SESSION['eventos'][$id]);
            return true;
        }
        return false;
    }    
    
}
