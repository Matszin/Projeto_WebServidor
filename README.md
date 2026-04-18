# Projeto_WebServidor
Projeto desenvolvido para matéria de web servidor

#  EventHub — Plataforma de Gestão de Eventos

![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=flat&logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Em%20desenvolvimento-yellow?style=flat)

> Plataforma web para criação e gerenciamento de eventos de qualquer natureza — corporativos, acadêmicos, culturais, esportivos, etc.

---

##  Integrantes

| Nome                        | Responsabilidades |
|-----------------------------|-------------------|
| **Mateus Nogari Teixeira**  | Criar/editar evento, painel do organizador, painel do admin, home/listagem de eventos |
| **Vitor de Anhaia Polski**  | Login e cadastro de conta, perfil do participante, página do evento |



---

##  Sobre o Projeto

O **EventHub** é uma aplicação web desenvolvida como projeto prático da disciplina de Servidor Web, utilizando PHP 8+ sem frameworks, seguindo o padrão MVC.

A plataforma permite que qualquer usuário se inscreva em eventos criados. O sistema conta com dois perfis de acesso — **Admin** e **Participante** 

---

##  Funcionalidades

- Autenticação com dois níveis de acesso: Admin e Participante
- Cadastro e edição de perfil (atualização de senhas)
- Criação e gerenciamento de eventos de qualquer tipo
- Listagem de eventos
- Inscrição em eventos
- Painel do admin: visão geral de todos os usuários
- Conceder ou tirar privilégios
- Excluir usuarios

- Falta linkar o painel do admin com o sistema de cadastro de usuários
```

 Estrutura de Pastas
/eventhub
  /app
    /controllers
      EventController.php
      UserController.php
    /models
      EventModel.php
      Auth.php
      UserModel.php
    /views
      /admin
        painel.php
      /auth
        login.php
        register.php
      /events
        criar_eventos.php
        detalhes_evento.php
        editar_eventos.php
        listar_eventos.php
        inscricoes.php
        gerenciar_eventos.php
      /partials
        header.php
        navbar.php
        footer.php
      /user
        perfil.php
  /config  
  /public         
    index.php
    /assets
      /css
        style.css
      /js
        main.js

```

##  Telas do Sistema

| # | Tela                       | Quem acessa                |
|---|----------------------------|----------------------------|
| 1 | Login                      | Todos                      |
| 2 | Cadastro de conta          | Todos                      |
| 3 | Perfil do participante     | Todos                      |
| 4 | Home / Listagem de eventos | Todos                      |
| 5 | Página do evento           | Todos                      |
| 6 | Criar / Editar evento      | Admin                      |
| 7 | Painel do admin            | Admin                      |

---
## Instalação e Configuração

### Requisitos

- PHP 8+
- Servidor web (Apache)
- MySQL / MariaDB *(Trabalho 2)*

### Como rodar localmente

```bash
# Clone o repositório
git clone https://github.com/Matszin/Projeto_WebServidor.git

# Acesse a pasta do projeto
cd Projeto_WebServidor

# Inicie o servidor embutido do PHP

php -S localhost:8000 -t public
```

> Acesse `http://localhost:8000` no navegador.

---
