<?php
session_start();

// CONFIGURAÇÃO DO BANCO
$conn = new PDO(
    "pgsql:host=localhost;dbname=sysnot",
    "postgres",
    "36291392"
);

// Simulando usuário logado
$user_id = 1;

// =========================
// 1️⃣ ENVIAR NOTIFICAÇÃO
// =========================
if (isset($_POST['message'])) {
    $stmt = $conn->prepare("
        INSERT INTO notifications (user_id, message)
        VALUES (:user_id, :message)
    ");

    $stmt->execute([
        'user_id' => $_POST['user_id'],
        'message' => $_POST['message']
    ]);

    header("Location: notifications.php");
    exit;
}

// =========================
// 2️⃣ RETORNAR JSON (AJAX)
// =========================
if (isset($_GET['fetch'])) {
    $stmt = $conn->prepare("
        SELECT * FROM notifications
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");

    $stmt->execute(['user_id' => $user_id]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// =========================
// 3️⃣ BUSCAR USUÁRIOS PARA SELECT
// =========================
$users = $conn->query("SELECT * FROM users")
              ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Notificações</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th {
            background: #222;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .unread {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<h2>Enviar Notificação (Admin)</h2>

<form method="POST">
    <select name="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>">
                <?= $user['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="message" placeholder="Mensagem" required>
    <button type="submit">Enviar</button>
</form>

<hr>

<h2>Notificações do Usuário</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Mensagem</th>
            <th>Data</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="notifications-body">
    </tbody>
</table>

<script>
function loadNotifications() {
    fetch('notifications.php?fetch=1')
        .then(res => res.json())
        .then(data => {
            let tbody = document.getElementById('notifications-body');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4">Nenhuma notificação</td>
                    </tr>
                `;
                return;
            }

            data.forEach(n => {
                tbody.innerHTML += `
                    <tr>
                        <td>${n.id}</td>
                        <td>${n.message}</td>
                        <td>${n.created_at}</td>
                        <td class="${n.is_read ? '' : 'unread'}">
                            ${n.is_read ? 'Lida' : 'Não lida'}
                        </td>
                    </tr>
                `;
            });
        });
}

setInterval(loadNotifications, 3000);
loadNotifications();
</script>

</body>
</html>