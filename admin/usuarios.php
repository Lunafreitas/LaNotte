<?php
require_once '../config/conn.php';
require_once '../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT id, nome, email, nivel FROM users WHERE nivel = 0 ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Usuários</title>
</head>

<body>
    <?php include '../includes/nav_admin.php' ?>
    <h2>Usuários cadastrados</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nome'] ?></td>
                <td><?= $user['email'] ?></td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>