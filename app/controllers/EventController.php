<?php
require_once __DIR__ . '/../models/EventModel.php';
class EventController {
    private $model;

    public function __construct() {
        $this->model = new EventModel();
    }

    // função para criar eventos
    public function store() {
        $dados = [
            'titulo'    => $_POST['titulo'] ?? '',
            'data'      => $_POST['data_evento'] ?? '',
            'tipo'      => $_POST['tipo_evento'] ?? '',
            'local'     => $_POST['local'] ?? '',
            'descricao' => $_POST['descricao'] ?? ''
        ];

        $this->model->save($dados);
    
        //manda direto pro eventos, para não duplicar igual antes
        header("Location: /index.php?page=home");
        exit;
    }

    // função paar editar eventos
    public function update() {
        $id = $_GET['id'] ?? null;

        $dados_atualizados = [
            'id'        => $id,
            'titulo'    => $_POST['titulo'] ?? '',
            'data'      => $_POST['data_evento'] ?? '',
            'tipo'      => $_POST['tipo_evento'] ?? '',
            'local'     => $_POST['local'] ?? '',
            'descricao' => $_POST['descricao'] ?? ''
        ];
        
        // atualiza na session
        $this->model->update($id, $dados_atualizados);
        
        // manda pra lista
        header("Location: /index.php?page=home");
        exit;
        
    }
    public function destroy(){
        $id = $_GET["id"] ?? null;

            if($id != null){
                $this->model->delete($id);
            }
            //manda para o home
            header("Location: /index.php?page=home");
        exit;
    }
}
