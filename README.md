🚀 Sistema de Notificações em Tempo Real com PHP + PostgreSQL
Um sistema simples e funcional de notificações em tempo real utilizando PHP, PostgreSQL e JavaScript (Polling).
O sistema permite:
✅ Enviar notificações através de uma tela administrativa
✅ Exibir notificações em tempo real para o usuário
✅ Atualização automática sem recarregar a página
✅ Estrutura com integridade relacional no banco de dados
📌 Demonstração do Funcionamento
O sistema possui duas áreas principais:
👨‍💼 Tela Admin
Envia notificações para um usuário específico
Insere dados na tabela notifications
👤 Tela do Usuário
Consulta as notificações a cada 3 segundos
Atualiza automaticamente a interface
Exibe as notificações em formato de tabela
🛠️ Tecnologias Utilizadas
PHP (PDO)
PostgreSQL
JavaScript (Fetch API)
HTML5
CSS3
🗄️ Estrutura do Banco de Dados
Tabela users
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
Tabela notifications
CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
⚙️ Como Rodar o Projeto
1️⃣ Clonar o repositório
git clone https://github.com/SEU-USUARIO/php-notification-system.git
cd php-notification-system
2️⃣ Configurar o Banco de Dados
Crie o banco:
CREATE DATABASE seubanco;
Depois crie as tabelas conforme os scripts acima.
3️⃣ Ajustar conexão no PHP
No arquivo de conexão, altere:
$conn = new PDO("pgsql:host=localhost;dbname=seubanco", "seu_usuario", "sua_senha");
Coloque seus dados reais do PostgreSQL.
4️⃣ Criar um usuário para testes
INSERT INTO users (name) VALUES ('Felipe');
Anote o ID gerado.
5️⃣ Rodar servidor local
Dentro da pasta do projeto:
php -S localhost:8000
Agora acesse:
http://localhost:8000/notifications.php
🔄 Como Funciona a Atualização em Tempo Real?
O sistema utiliza Polling com JavaScript:
setInterval(loadNotifications, 3000);
A cada 3 segundos o navegador consulta o arquivo get_notifications.php, que retorna as notificações em formato JSON.
Isso permite atualização automática sem recarregar a página.
🧠 Conceitos Aplicados
Uso de PDO com prepared statements
Foreign Key para integridade referencial
Comunicação assíncrona com Fetch API
Estrutura MVC simplificada
Atualização dinâmica de DOM
🔮 Melhorias Futuras
 Marcar notificação como lida
 Contador de notificações (badge)
 Sistema de autenticação
 WebSockets ao invés de polling
 Sistema multiusuário real
📄 Licença
Projeto para fins educacionais e portfólio.
👨‍💻 Autor
Felipe Gomes
Desenvolvedor em evolução 🚀
