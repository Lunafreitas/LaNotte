<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if(isset($_POST['submit'])) {

    $id = $_GET['id'];
    $nome = $_POST['nome'];

    $stmt = $pdo->prepare('UPDATE categorias SET nome = :nome WHERE id = :id');
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: ../categorias.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Editar Categoria</title>
</head>
<body>

<form action="" method="post">
    <label>Nome *</label><br>
    <input type="text" name="nome" required><br>
    <a href="categorias.php">Cancelar</a>
    <input type="submit" name="submit">
</form>
    
</body>
</html>