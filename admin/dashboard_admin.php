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
<title>Admin</title>
</head>
<body>

<?php include '../includes/nav_admin.php' ?>

<h1>Painel Admin</h1>
<p>Bem-vindo, <?= $_SESSION['user_nome'] ?></p>

</body>
</html>