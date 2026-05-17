<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if(isset($_GET['id'])) 
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
    <input type="text"><br>
    <a href="../categorias.php">Cancelar</a>
    <input type="submit" name="Salvar">
</form>
    
</body>
</html>