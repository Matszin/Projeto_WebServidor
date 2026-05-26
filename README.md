# EventHub — Plataforma de Gestão de Eventos

![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=flat&logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Em%20desenvolvimento-yellow?style=flat)

> Plataforma web para criação e gerenciamento de eventos de qualquer natureza — corporativos, acadêmicos, culturais, esportivos, etc.

---

## Integrantes

| Nome                        | Responsabilidades |
|-----------------------------|-------------------|
| **Mateus Nogari Teixeira**  | Criar/editar evento, painel do organizador, painel do admin, home/listagem de eventos |
| **Vitor de Anhaia Polski**  | Login e cadastro de conta, perfil do participante, página do evento |

---

## Sobre o Projeto

O **EventHub** é uma aplicação web desenvolvida como projeto prático da disciplina de Servidor Web, utilizando PHP 8+ sem frameworks, seguindo o padrão MVC.

A plataforma permite que qualquer usuário se inscreva em eventos criados. O sistema conta com dois perfis de acesso — **Admin** e **Participante**.

---

## Funcionalidades

- Autenticação com dois níveis de acesso: Admin e Participante
- Cadastro e edição de perfil (atualização de senhas)
- Criação e gerenciamento de eventos de qualquer tipo
- Listagem de eventos
- Inscrição em eventos
- Painel do admin: visão geral de todos os usuários
- Conceder ou retirar privilégios de admin
- Excluir usuários

---

## Requisitos de Instalação

- PHP 8.0 ou superior
- Extensão `pdo_mysql` habilitada no PHP
- MySQL 5.7+ ou MariaDB 10.3+
- Composer 2.x
- Servidor web Apache (ou servidor embutido do PHP para desenvolvimento)

---

## Instalação e Configuração

### 1. Clonar o repositório

```bash
git clone https://github.com/Matszin/Projeto_WebServidor.git
cd Projeto_WebServidor
```

### 2. Instalar as dependências via Composer

Primeiramente baixar o composer

```bash
Rodar no terminal: composer install
```

### 3. Configurar as variáveis de ambiente

Copie o arquivo de exemplo e preencha com os dados do seu ambiente:

```bash
cp .env.example .env
```

Abra o arquivo `.env` e edite:

```ini
DB_HOST=localhost       # host do banco de dados
DB_NAME=eventos         # nome do banco de dados
DB_USER=root            # usuário do MySQL
DB_PASS=                # senha do MySQL
```

### 4. Criar o banco de dados

Acesse seu MySQL/MariaDB e execute o SQL abaixo:
 também há o arquivo database.sql

```sql
CREATE DATABASE IF NOT EXISTS eventos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE eventos;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE eventos (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    titulo    VARCHAR(200)  NOT NULL,
    data      DATE          NOT NULL,
    tipo      VARCHAR(100)  NOT NULL,
    local     VARCHAR(200)  NOT NULL,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inscricoes (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT NOT NULL,
    evento_id INT NOT NULL,
    inscrito_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_inscricao (user_id, evento_id),
    FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
    FOREIGN KEY (evento_id) REFERENCES eventos(id) ON DELETE CASCADE
);
```


### 5. Rodar o projeto

**Com servidor embutido do PHP:**

```bash
php -S localhost:8000 -t public
```

Acesse `http://localhost:8000` no navegador.

**Com Apache:** configure o `DocumentRoot` para a pasta `public/` do projeto.

---

## Estrutura de Pastas

```
/eventhub
  /app
    /config
      database.php        ← configuração do banco (lê do .env)
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
  /public
    index.php             ← front controller (roteador)
    /assets
      /css / /js
  /vendor                 ← gerado pelo Composer (não versionar)
  .env                    ← variáveis de ambiente (não versionar)
  .env.example            ← modelo para o .env (versionar)
  composer.json
```

---

## Telas do Sistema

| # | Tela                       | Quem acessa                |
|---|----------------------------|----------------------------|
| 1 | Login                      | Todos                      |
| 2 | Cadastro de conta          | Todos                      |
| 3 | Perfil do participante     | Todos logados              |
| 4 | Home / Listagem de eventos | Todos logados              |
| 5 | Página do evento           | Todos logados              |
| 6 | Criar / Editar evento      | Admin                      |
| 7 | Painel do admin            | Admin                      |
