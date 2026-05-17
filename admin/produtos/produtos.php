<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT produtos.*, categorias.nome AS categoria_nome FROM produtos LEFT JOIN categorias ON produtos.categoria_id = categorias.id");

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Produtos</title>
</head>
<body>

<?php include '../../includes/nav_admin.php' ?>
<h2>Gerenciamento de Produtos</h2>

<a href="addP.php">Adicionar Produto</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td>
                <?php if (!empty($produto['img_url'])): ?>
                    <img src="../../images/<?= $produto['img_url'] ?>" width="80">

                <?php else: ?>
                    <p>Sem imagem</p>
                <?php endif; ?>
            </td>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['categoria_nome'] ?></td>
            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td> <!-- colocar no formato do real -->

            <td><?= $produto['disponivel'] ?></td>

            <td>
                <a href="editarP.php?id=<?= $produto['id'] ?>">Editar</a>
                <a href="deleteP.php?id=<?= $produto['id'] ?>" onclick="return confirm('Deseja excluir este produto? Esta ação não pode ser desfeita.')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>