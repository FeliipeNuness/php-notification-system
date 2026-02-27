# 🚀 Sistema de Notificações em Tempo Real

### PHP + PostgreSQL + JavaScript (Polling)

------------------------------------------------------------------------

## 📌 Sobre o Projeto

Sistema simples e funcional de **notificações em tempo real**
desenvolvido com **PHP (PDO)**, **PostgreSQL** e **JavaScript (Fetch
API)**.

O projeto demonstra conceitos importantes de backend, banco relacional e
comunicação assíncrona.

------------------------------------------------------------------------

## ✨ Funcionalidades

-   ✅ Envio de notificações via tela administrativa\
-   ✅ Listagem automática de notificações\
-   ✅ Atualização a cada 3 segundos (sem reload)\
-   ✅ Integração com banco relacional\
-   ✅ Uso de Foreign Key\
-   ✅ Estrutura simples e organizada

------------------------------------------------------------------------

## 🖥️ Estrutura do Sistema

### 👨‍💼 Área Administrativa

Responsável por: - Inserir notificações - Associar notificação a um
usuário específico - Persistir dados no banco

### 👤 Área do Usuário

Responsável por: - Buscar notificações via `get_notifications.php` -
Atualizar interface automaticamente - Exibir notificações em formato de
tabela

------------------------------------------------------------------------

## 🛠️ Tecnologias Utilizadas

  Tecnologia     Função
  -------------- -----------------------------
  PHP (PDO)      Backend e conexão com banco
  PostgreSQL     Banco de dados relacional
  JavaScript     Atualização dinâmica
  Fetch API      Requisições assíncronas
  HTML5 / CSS3   Estrutura e layout

------------------------------------------------------------------------

# 🗄️ Banco de Dados

## 📌 Tabela `users`

``` sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
```

## 📌 Tabela `notifications`

``` sql
CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

------------------------------------------------------------------------

# ⚙️ Como Executar o Projeto

## 1️⃣ Clonar o Repositório

``` bash
git clone https://github.com/SEU-USUARIO/php-notification-system.git
cd php-notification-system
```

## 2️⃣ Criar Banco de Dados

``` sql
CREATE DATABASE seubanco;
```

Depois execute os scripts das tabelas acima.

## 3️⃣ Configurar Conexão no PHP

``` php
$conn = new PDO("pgsql:host=localhost;dbname=seubanco", "seu_usuario", "sua_senha");
```

Substitua pelos seus dados reais.

## 4️⃣ Inserir Usuário de Teste

``` sql
INSERT INTO users (name) VALUES ('Felipe');
```

## 5️⃣ Rodar Servidor Local

``` bash
php -S localhost:8000
```

Acesse:

    http://localhost:8000/notifications.php

------------------------------------------------------------------------

# 🔄 Como Funciona a Atualização em Tempo Real?

O sistema utiliza **Polling com JavaScript**:

``` javascript
setInterval(loadNotifications, 3000);
```

A cada 3 segundos: - O navegador faz requisição ao backend - O PHP
consulta o banco - Retorna JSON - A interface é atualizada
automaticamente

------------------------------------------------------------------------

# 🧠 Conceitos Aplicados

-   ✔ PDO com prepared statements\
-   ✔ Integridade referencial (Foreign Key)\
-   ✔ Comunicação assíncrona\
-   ✔ Manipulação de DOM\
-   ✔ Estrutura MVC simplificada

------------------------------------------------------------------------

# 🔮 Melhorias Futuras

-   [ ] Marcar notificação como lida\
-   [ ] Badge com contador\
-   [ ] Sistema de autenticação\
-   [ ] WebSockets ao invés de polling\
-   [ ] Sistema multiusuário completo

------------------------------------------------------------------------

# 👨‍💻 Autor

**Felipe Gomes**\
Desenvolvedor em evolução 🚀
