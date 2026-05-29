<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id')->fetch(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare('SELECT * FROM pedidos ORDER BY id');
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($pedidos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin — Pedidos</title>
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
            <h2>Histórico de Pedidos</h2>
        </div>
    </div>
</div>

<?php if ($total === 0): ?>
    <div class="carrinho-vazio">
        <p class="carrinho-vazio-txt" style="color: #bb915777;">Nenhum pedido encontrado.</p>
    </div>
<?php else: ?>
<div class="tabela-wrap">
        <div class="tabela-topo">
            <span class="tabela-label">Todos os Pedidos</span>
            <span class="tabela-count"><?= $total ?> pedido(s)</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td><?= $pedido['user_id'] ?></td>
                            <td><?= $pedido['status'] ?></td>
                            <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>
                            <td><?= $pedido['status'] ?></td>
                            <td>
                                <a href="excluir_pedido.php?id=<?= $pedido['id'] ?>" class="btn-deletar" onclick="return confirm('Deseja cancelar este pedido? Esta ação não pode ser desfeita.')">
                                    <i class="fa-solid fa-trash"></i> Cancelar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

</body>
</html>