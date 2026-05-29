<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id')->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM pedidos WHERE user_id = :user_id ORDER BY id DESC LIMIT 15');
$stmt->bindValue(':user_id', $_SESSION['user_id']);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count_pedidos = count($pedidos);

$img_user = !empty($user['img_user']) ? $user['img_user'] : 'semfoto.jpg';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Meu Histórico</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/LaNotte/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="user">

    <?php include '../../includes/nav_user.php'; ?>

    <div class="cardapio-user-header">
        <div>
            <span class="section-tag">Seu histórico de pedidos</span>
            <h2 class="section-h2">Meus Pedidos</h2>
        </div>
    </div>
    <?php if ($count_pedidos === 0): ?>
        <div class="carrinho-vazio">
            <i class="fa-solid fa-receipt"></i>
            <p class="carrinho-vazio-txt">Você ainda não fez nenhum pedido, ou ele foi cancelado.</p>
            <a href="../cardapio/cardapio.php" class="btn-voltar-cardapio">
                <i class="fa-solid fa-arrow-left"></i> Ver Cardápio
            </a>
        </div>
    <?php else: ?>
        <div class="carrinho-layout" style="  grid-template-columns: 1fr 0;">
            <div class="carrinho-tabela-wrap">
                <div class="carrinho-tabela-topo">
                    <span class="carrinho-tabela-label">Histórico de Pedidos</span>
                </div>
                <table class="carrinho-tabela">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Quantidade</th>
                            <th>Horário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?= $pedido['pedido'] ?></td>
                                <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>
                                <td>
                                    <?php
                                    $s = strtolower($pedido['status']);
                                    $cls = match (true) {
                                        str_contains($s, 'entregue') => 'historico-status-entregue',
                                        str_contains($s, 'cancelado') => 'historico-status-cancelado',
                                        default => 'historico-status-pendente'
                                    };
                                    ?>
                                    <span class="historico-status <?= $cls ?>">
                                        <?= ucfirst($pedido['status']) ?>
                                    </span>
                                </td>
                                <td><?= $pedido['quantidade'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            </div>
        </div>

</body>

</html>