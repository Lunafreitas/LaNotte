<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if (!isset($_GET['id'])) {
    header('Location: /LaNotte/public/admin/produtos/produtos.php');
    exit();
}

$id = $_GET['id'];
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: /LaNotte/public/admin/produtos/produtos.php');
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

    header('Location: /LaNotte/public/admin/produtos/produtos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Editar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="admin">
    <?php include '../../includes/nav_admin.php'; ?>
    <div class="form-page">
        <!-- Formulário -->
        <div class="form-conteudo">
            <div class="eyebrow" style="margin-bottom:8px;">Editar Produto</div>
            <h2 style="margin-bottom:28px;">Editar Produto</h2>

            <form method="post" enctype="multipart/form-data" class="form-grid">
                <div class="form-campo">
                <label>Categoria</label>
                <select name="categoria_id" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $produto['categoria_id']) ? 'selected' : '' ?>>

                            <?= $categoria['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-campo">
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
                </div>

                <div class="form-campo">
                    <label>Descrição</label>
                    <textarea name="descricao"><?= $produto['descricao'] ?></textarea>
                </div>

                <div class="form-campo">
                    <label>Preço</label>
                    <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>
                </div>

                <div class="form-campo">
                    <label>Nova Imagem</label>
                    <input type="file" name="imagem">
                </div>

                <div class="form-campo">
                    <label>Status</label>
                    <select name="disponivel">
                    <option value="Disponível" <?= ($produto['disponivel'] == 'Disponível') ? 'selected' : ''?>>
                        Disponível
                    </option>
                    
                    <option value="Indisponível"
                    <?= ($produto['disponivel'] == 'Indisponível') ? 'selected' : '' ?>>Indisponível
                     </option>
                    </select>
                </div>

                <div class="form-acoes">
                    <button type="submit" name="submit" class="btn-form-salvar">Atualizar</button>
                    <a href="/public/admin/produtos/produtos.php" class="btn-form-cancelar"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
                </div>

            </form>

        </div>
    </div>
</body>

</html>