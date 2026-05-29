<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if (!isset($_GET['id'])) {
    header('Location: produtos.php');
    exit();
}

$id = $_GET['id'];
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: produtos.php');
    exit();
}

if (isset($_POST['submit'])) {
    $categoria_id = $_POST['categoria_id'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $disponivel = $_POST['disponivel'];
    $img_url = $produto['img_url'];

    if (!empty($_FILES['imagem']['name'])) {
        $novaImagem = $_FILES['imagem']['name'];

        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            "../../images/" . $novaImagem
        );

        $img_url = $novaImagem;
    }

    $update = $pdo->prepare("UPDATE produtos SET categoria_id = :categoria_id, nome = :nome, descricao = :descricao,preco = :preco, img_url = :img_url, disponivel = :disponivel WHERE id = :id");

    $update->bindValue(':categoria_id', $categoria_id);
    $update->bindValue(':nome', $nome);
    $update->bindValue(':descricao', $descricao);
    $update->bindValue(':preco', $preco);
    $update->bindValue(':img_url', $img_url);
    $update->bindValue(':disponivel', $disponivel);
    $update->bindValue(':id', $id);

    $update->execute();

    header('Location: produtos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Editar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="admin">
    <?php include '../../includes/nav_admin.php'; ?>
    <div class="page-header">
        <div class="eyebrow">Editar item</div>
        <h2>Editar Produto</h2>
    </div>

    <form method="post" enctype="multipart/form-data">

        <label>Categoria</label><br>
        <select name="categoria_id" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $produto['categoria_id']) ? 'selected' : '' ?>>

                    <?= $categoria['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Nome</label><br>
        <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>

        <label>Descrição</label><br>
        <textarea name="descricao"><?= $produto['descricao'] ?></textarea><br>

        <label>Preço</label><br>
        <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br>

        <label>Imagem Atual</label><br>
        <img src="../../images/<?= $produto['img_url'] ?>" width="120"><br>

        <label>Nova Imagem</label><br>
        <input type="file" name="imagem"><br>

        <label>Status</label><br>
        <select name="disponivel">
            <option
                value="Disponível"
                <?= ($produto['disponivel'] == 'Disponível')
                    ? 'selected'
                    : ''
                ?>>
                Disponível
            </option>

            <option value="Indisponível"
                <?= ($produto['disponivel'] == 'Indisponível')
                    ? 'selected'
                    : ''
                ?>>
                Indisponível
            </option>
        </select><br>

        <button type="submit" name="submit">Atualizar</button>

    </form>

</body>

</html>