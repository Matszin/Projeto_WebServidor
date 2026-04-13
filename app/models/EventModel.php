<?php
class EventModel {
    public function save($dados) {
        
        error_log("Simulando salvamento de evento: " . print_r($dados, true));
        
        return true;//retorna sucesso
    }

    public function all() {
        // Mock de uma lista de eventos
        return [
            ['id' => 1, 'titulo' => 'Workshop PHP', 'data' => '2026-05-10'],
            ['id' => 2, 'titulo' => 'Hackathon EventHub', 'data' => '2026-06-15']
        ];
    }
}
