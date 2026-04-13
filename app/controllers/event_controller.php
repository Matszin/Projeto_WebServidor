<?php

require_once __DIR__ . '/../models/EventModel.php';

$action = $_GET['action'] ?? '';

if ($action === 'store') {
    $controller = new EventController();
    $controller->store();
}

class EventController {
    public function store() {
        //pega os dados do formulário
        $dados = [
            'titulo'    => $_POST['titulo'] ?? '',
            'data'      => $_POST['data_evento'] ?? '',
            'tipo'      => $_POST['tipo_evento'] ?? '',
            'local'     => $_POST['local'] ?? '',
            'descricao' => $_POST['descricao'] ?? ''
        ];

        //envia para o Model
        $model = new EventModel();
        $salvou = $model->save($dados);

        if ($salvou) {
           //alerta de sucesso
            echo "<script>alert('Evento criado com sucesso (MOCK)!'); window.location.href='/index.php?page=eventos';</script>";
        }
    }
}
