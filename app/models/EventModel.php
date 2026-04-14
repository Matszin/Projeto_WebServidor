<?php
class EventModel {
    public function all() {
        
        return [
            [
                'id' => 1,'titulo' => 'Workshop de PHP Moderno','data' => '2026-05-15 14:00',
                'local' => 'Auditório Central','tipo' => 'Acadêmico',
            ],
            [
                'id' => 2,'titulo' => 'Hackathon EventHub 2026','data' => '2026-06-20 09:00',
                'local' => 'Laboratório de Informática','tipo' => 'Tecnologia',
                
            ]
        ];
    }
}
