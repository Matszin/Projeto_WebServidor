<?php


class EventModel {

    public function __construct() {
        //Inicia a sessão se elanão estiver ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        
        if (!isset($_SESSION['eventos_mock'])) {
            $_SESSION['eventos_mock'] = [
                1 => [
                    'id' => 1, 'titulo' => 'Workshop de PHP Moderno', 'data' => '2026-05-15T14:00',
                    'tipo' => 'academico', 'local' => 'Auditório Central',
                    'descricao' => 'Aprenda as melhores práticas de PHP.', 'imagem' => 'https://via.placeholder.com/300x150'
                ],
                2 => [
                    'id' => 2, 'titulo' => 'Hackathon EventHub', 'data' => '2026-06-20T09:00',
                    'tipo' => 'corporativo', 'local' => 'Laboratório 04',
                    'descricao' => '24 horas de código e muita pizza!', 'imagem' => 'https://via.placeholder.com/300x150'
                ]
            ];
        }
    }

    // busca eventos para editar
    public function find($id) {
        return $_SESSION['eventos_mock'][$id] ?? null;
    }

    // criar eventos
    public function save($dados) {
        // Gera um novo id baseado no último
        $novo_id = count($_SESSION['eventos_mock']) + 1;
        $dados['id'] = $novo_id;
        $dados['imagem'] = 'https://via.placeholder.com/300x150'; // Imagem padrão

        //salva na session
        $_SESSION['eventos_mock'][$novo_id] = $dados;
        
        return true;
    }

    // listar eventos
    public function all() {
        return $_SESSION['eventos_mock'];
    }

    // session para salvar evento
    public function update($id, $dados) {
        if (isset($_SESSION['eventos_mock'][$id])) {
            // Mantém o ID original e atualiza o restante
            $dados['id'] = $id;
            $_SESSION['eventos_mock'][$id] = array_merge($_SESSION['eventos_mock'][$id], $dados);
            return true;
        }
        return false;
    }
}
