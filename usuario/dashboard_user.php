<?php
require_once '../config/conn.php';
require_once '../login/autenticacao.php';

verificarUser();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuário</title>
</head>
<body>
<?php include '../includes/nav_user.php' ?>
<h1>Área do Usuário</h1>

<p>Bem-vindo, <?= $_SESSION['user_nome'] ?></p>

<p>Email: <?= $_SESSION['user_email'] ?></p>

<a href="../login/logout.php">Sair</a>

</body>
</html>