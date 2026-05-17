<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if(!isset($_GET['id'])) {
    header('Location: produtos.php');
    exit();
}

$id = $_GET['id'];

$categorias = $pdo->query("
    SELECT * FROM categorias
")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT * FROM produtos
    WHERE id = :id
");

$stmt->bindValue(':id', $id);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$produto) {
    header('Location: produtos.php');
    exit();
}

if(isset($_POST['submit'])) {

    $categoria_id = $_POST['categoria_id'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $disponivel = $_POST['disponivel'];

    /*
    =========================
    IMAGEM
    =========================
    */

    $img_url = $produto['img_url'];

    if(!empty($_FILES['imagem']['name'])) {

        $novaImagem = $_FILES['imagem']['name'];

        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            "../../images/" . $novaImagem
        );

        $img_url = $novaImagem;
    }

    /*
    =========================
    UPDATE
    =========================
    */

    $update = $pdo->prepare("
        UPDATE produtos
        SET
            categoria_id = :categoria_id,
            nome = :nome,
            descricao = :descricao,
            preco = :preco,
            img_url = :img_url,
            disponivel = :disponivel
        WHERE id = :id
    ");

    $update->execute([
        ':categoria_id' => $categoria_id,
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':img_url' => $img_url,
        ':disponivel' => $disponivel,
        ':id' => $id
    ]);

    header('Location: produtos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>

<body>
    
<h2>Editar Produto</h2>

<form method="post" enctype="multipart/form-data">

    <label>Categoria</label>
    <br>

    <select name="categoria_id" required>

        <?php foreach($categorias as $categoria): ?>

            <option 
                value="<?= $categoria['id'] ?>"

                <?= ($categoria['id'] == $produto['categoria_id']) 
                    ? 'selected' 
                    : '' 
                ?>
            >

                <?= $categoria['nome'] ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Nome</label>
    <br>

    <input 
        type="text"
        name="nome"
        value="<?= $produto['nome'] ?>"
        required
    >

    <br><br>

    <label>Descrição</label>
    <br>

    <textarea name="descricao"><?= $produto['descricao'] ?></textarea>

    <br><br>

    <label>Preço</label>
    <br>

    <input
        type="number"
        step="0.01"
        name="preco"
        value="<?= $produto['preco'] ?>"
        required
    >

    <br><br>

    <label>Imagem Atual</label>
    <br>

    <img
        src="../../images/<?= $produto['img_url'] ?>"
        width="120"
    >

    <br><br>

    <label>Nova Imagem</label>
    <br>

    <input type="file" name="imagem">

    <br><br>

    <label>Status</label>
    <br>

    <select name="disponivel">

        <option 
            value="Disponível"

            <?= ($produto['disponivel'] == 'Disponível')
                ? 'selected'
                : ''
            ?>
        >
            Disponível
        </option>

        <option 
            value="Indisponível"

            <?= ($produto['disponivel'] == 'Indisponível')
                ? 'selected'
                : ''
            ?>
        >
            Indisponível
        </option>

    </select>

    <br><br>

    <button type="submit" name="submit">
        Atualizar
    </button>

</form>

</body>
</html>