<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT * FROM categorias");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Categorias</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <?php include '../../includes/nav_admin.php' ?>
    <h2>Gestão de Categorias</h2>
    <a href="addA.php">Adicionar Categoria</a>

        <?php foreach ($categorias as $categoria): ?>
            <div>
                <p><?= $categoria['nome'] ?></p>
                <p>Ordem #<?= $categoria['id'] ?></p>
                <a href="editarA.php?id=<?= $categoria['id'] ?>">Editar</a>
                <a href="deleteA.php?id=<?= $categoria['id'] ?>" onclick="return confirm('Excluir? Esta ação não pode ser desfeita')">Excluir</i></a>
            </div>
        <?php endforeach; ?>

    </table>

</body>

</html>