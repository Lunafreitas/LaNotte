<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$categorias = $pdo->query("SELECT * FROM categorias")
                  ->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {
    $categoria_id = $_POST['categoria_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $disponivel = $_POST['disponivel'];

    $imagem = $_FILES['imagem']['name']; //pra bota imagem/ arquivo

    move_uploaded_file($_FILES['imagem']['tmp_name'], "../../images/" . $imagem); //salva arquivo que foi enviado por um formulario, botar imagem

    $stmt = $pdo->prepare("INSERT INTO produtos (categoria_id, nome, descricao, preco, img_url, disponivel) VALUES (:categoria_id, :nome, :descricao, :preco, :img_url, :disponivel)");
    $stmt->bindValue(':categoria_id', $categoria_id);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':img_url', $imagem);
    $stmt->bindValue(':disponivel', $disponivel);

    $stmt->execute();

    header('Location: produtos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Adicionar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="admin">
<div class="page-header">
    <div class="eyebrow">Novo item</div>
    <h2>Adicionar Produto</h2>
</div>

<form method="post" enctype="multipart/form-data"> <!-- obrigatorio para formularios que recebem arquivos -->
    <label>Categoria</label><br>
    <select name="categoria_id" required>

        <?php foreach($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>">
                <?= $categoria['nome'] ?>
            </option>
        <?php endforeach; ?>

    </select><br>

    <label>Nome</label><br>
    <input type="text" name="nome" required><br>

    <label>Descrição</label><br>
    <textarea name="descricao"></textarea><br>

    <label>Preço</label><br>
    <input type="number" step="0.01" name="preco" required><br>

    <label>Imagem</label><br>
    <input type="file" name="imagem" required><br>

    <label>Status</label><br>

    <select name="disponivel">
        <option value="Disponível">
            Disponível
        </option>

        <option value="Indisponível">
            Indisponível
        </option>
    </select><br>

    <a href="produtos.php">Cancelar</a>
    <input type="submit" name="submit">

</form>

</body>
</html>