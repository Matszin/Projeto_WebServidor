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
    //função para excluir eventos
    public function destroy() {
    //pega url
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // pega o id
    preg_match('#^/eventos/(\d+)/deletar$#', $uri, $m);
    $id = $m[1] ?? null;

    if ($id != null) {
        $this->model->delete($id);
    }
    
    header("Location: /eventos/gerenciar");
    exit;
}

}
