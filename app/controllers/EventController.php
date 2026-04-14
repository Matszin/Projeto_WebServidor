<?php

require_once __DIR__ . '/../models/EventModel.php'; //importa o model

$action = $_GET['action'] ?? ''; //pega qual ação deve ser feita


$controller = new EventController();

if ($action === 'store') {
    $controller->store();
} elseif ($action === 'update') {
    $controller->update();
}

class EventController {

    private $model;

    public function __construct() {
        $this->model = new EventModel();
    }

   
    public function store() {//função para criar eventos
        // Pega os dados
        $dados = [
            'titulo'    => $_POST['titulo'] ?? '',
            'data'      => $_POST['data_evento'] ?? '',
            'tipo'      => $_POST['tipo_evento'] ?? '',
            'local'     => $_POST['local'] ?? '',
            'descricao' => $_POST['descricao'] ?? ''
        ];
    
        // Manda para o model
        $sucesso = $this->model->save($dados);

        if ($sucesso) {
            
            echo "<script>
                    alert('Evento criado com sucesso (Simulação)!');
                    window.location.href = '/index.php?page=eventos';
                  </script>";
        }
    }

    
    public function update() { //função para editar eventos
        $id = $_GET['id'] ?? null;

        $dados_atualizados = [
            'id'        => $id,
            'titulo'    => $_POST['titulo'] ?? '',
            'data'      => $_POST['data_evento'] ?? '',
            'tipo'      => $_POST['tipo_evento'] ?? '',
            'local'     => $_POST['local'] ?? '',
            'descricao' => $_POST['descricao'] ?? ''
        ];
          $sucesso = $this->model->update($id, $dados_atualizados);
   
        error_log("CONTROLLER: Atualizando evento ID $id com dados: " . print_r($dados_atualizados, true));

        echo "<script>
                alert('Evento ID $id atualizado com sucesso (Simulação)!');
                window.location.href = '/index.php?page=eventos';
              </script>";
    }
}
