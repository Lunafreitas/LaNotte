<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if(isset($_POST['submit'])) {
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare('INSERT INTO categorias (nome) VALUES (:categoria)');
    $stmt->bindValue(':categoria', $categoria);
    $stmt->execute();
    header('Location: categorias.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Adicionar Categoria</title>
</head>
<body>
    
    <form method="post">
        <label>Nome *</label>
        <input type="text" name="categoria" required>
        <a href="categorias.php">Cancelar</a>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>