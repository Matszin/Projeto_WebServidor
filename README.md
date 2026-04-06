# Projeto_WebServidor
Projeto desenvolvido para matéria de web servidor

# 🗓️ EventHub — Plataforma de Gestão de Eventos

![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=flat&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat&logo=bootstrap&logoColor=white)
![Status](https://img.shields.io/badge/Status-Em%20desenvolvimento-yellow?style=flat)

> Plataforma web para criação e gerenciamento de eventos de qualquer natureza — corporativos, acadêmicos, culturais, esportivos, etc.

---

## 👥 Integrantes

| Nome                        | Responsabilidades |
|-----------------------------|-------------------|
| **Ambos**                   |Login e cadastro de conta|
| **Mateus Nogari Teixeira**  | Criar/editar evento, painel do organizador, painel do admin |

| **Vitor de Anhaia Polski**  | Perfil do participante, home/listagem de eventos, página do evento |



---

## 📌 Sobre o Projeto

O **EventHub** é uma aplicação web desenvolvida como projeto prático da disciplina de Servidor Web, utilizando PHP 8+ sem frameworks, seguindo o padrão MVC.

A plataforma permite que qualquer usuário crie eventos e gerencie inscrições, ou que se inscreva em eventos criados por outros. O sistema conta com dois perfis de acesso — **Admin** e **Participante** — sendo que o participante pode assumir o papel de organizador ao criar um evento, e pode ser promovido a palestrante dentro de um evento específico mediante aprovação do organizador.

---

## ✅ Funcionalidades

- Autenticação com dois níveis de acesso: Admin e Participante
- Cadastro e edição de perfil (foto, bio, área de atuação, links)
- Criação e gerenciamento de eventos de qualquer tipo
- Listagem de eventos com filtros por nome, tipo e data
- Inscrição em eventos (reserva ou compra de ingresso)
- Requisição para ser palestrante em um evento, com aprovação/rejeição pelo organizador
- Painel do organizador: lista de inscritos e gerenciamento de requisições
- Painel do admin: visão geral de todos os usuários e eventos da plataforma

```

🗂️ Estrutura de Pastas *até o momento*
/eventhub
  /app
    /views
      /partials
        header.php
        navbar.php
        footer.php
  /config  
  /public         
    index.php
    /assets
      /css
        style.css
      /js
        main.js

```

## 🖥️ Telas do Sistema

| # | Tela                       | Quem acessa                |
|---|----------------------------|----------------------------|
| 1 | Login                      | Todos                      |
| 2 | Cadastro de conta          | Público                    |
| 3 | Perfil do participante     | Participante               |
| 4 | Home / Listagem de eventos | Todos                      |
| 5 | Página do evento           | Todos                      |
| 6 | Criar / Editar evento      | Participante (organizador) |
| 7 | Painel do organizador      | Participante (organizador) |
| 8 | Painel do admin            | Admin                      |

---
## 🚀 Instalação e Configuração

### Requisitos

- PHP 8+
- Servidor web (Apache ou Nginx) ou PHP built-in server
- MySQL / MariaDB *(Trabalho 2)*

### Como rodar localmente

```bash
# Clone o repositório
git clone https://github.com/Matszin/Projeto_WebServidor.git

# Acesse a pasta do projeto
cd Projeto_WebServidor

# Inicie o servidor embutido do PHP
php -S localhost:8000 -t public/
```

> Acesse `http://localhost:8000` no navegador.

### Configuração

- Copie o arquivo `config/database.example.php` para `config/database.php`
- Preencha as credenciais do banco de dados *(necessário a partir do Trabalho 2)*

---

## 📊 Status do Desenvolvimento

| Tela / Funcionalidade |  Status |
|-----------------------|--------|
| Login e Cadastro |  🔲 Pendente |
| Perfil do participante | 🔲 Pendente |
| Home / Listagem de eventos | 🔲 Pendente |
| Página do evento + inscrição | 🔲 Pendente |
| Criar / Editar evento  | 🔲 Pendente |
| Painel do organizador | 🔲 Pendente |
| Painel do admin  | 🔲 Pendente |
| Autenticação e sessão (PHP) | 🔲 Pendente |
| Estrutura MVC base  | 🔲 Pendente |

> Legenda: 🔲 Pendente · 🟡 Em andamento · ✅ Concluído
