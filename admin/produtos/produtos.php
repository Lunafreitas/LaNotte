<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT produtos.*, categorias.nome AS categoria_nome FROM produtos LEFT JOIN categorias ON produtos.categoria_id = categorias.id");

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($produtos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin — Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="admin">

<?php include '../../includes/nav_admin.php'; ?>

<div class="main">
    <div class="page-header">
        <div>
            <div class="eyebrow">Gestão</div>
            <h2>Produtos</h2>
        </div>
        <a href="addP.php" class="add">
            <i class="fa-solid fa-plus"></i> Adicionar Produto
        </a>
    </div>

    <!-- Tabela -->
    <div class="tabela-wrap">
        <div class="tabela-topo">
            <span class="tabela-label">Todos os Produtos</span>
            <span class="tabela-count"><?= $total ?> produto(s)</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Prato</th>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td class="td-img">
                                    <img src="../../images/<?= $produto['img_url'] ?>" alt="<?= $produto['nome'] ?>">
                            </td>
                            <td class="td-id"><?= $produto['id'] ?></td>
                            <td class="td-nome"><?= $produto['nome'] ?></td>
                            <td><?= $produto['categoria_nome'] ?></td>
                            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <td><?= $produto['disponivel'] ?></td>
                            <td>
                                <div class="td-acoes">
                                    <a href="editarP.php?id=<?= $produto['id'] ?>" class="btn-editar">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a href="deleteP.php?id=<?= $produto['id'] ?>"
                                       class="btn-deletar"
                                       onclick="return confirm('Deseja excluir este produto? Esta ação não pode ser desfeita.')">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
