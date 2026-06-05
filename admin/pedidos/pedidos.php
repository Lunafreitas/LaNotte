<?php
require_once '../../config/conn.php';
require_once '../login/autenticacao.php';

verificarAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alterar_status'])) {
    $pedido_id = (int) $_POST['pedido_id'];
    $status = $_POST['status'];

    $status_validos = ['Esperando Confirmação', 'Preparando', 'Enviando'];

    if ($pedido_id > 0){
        $update = $pdo->prepare("UPDATE pedidos SET status = :status WHERE id = :id");
        $update->bindValue(':status', $status);
        $update->bindValue(':id', $pedido_id, PDO::PARAM_INT);
        $update->execute();
    }

    header('Location: /LaNotte/public/admin/pedidos/pedidos.php');
    exit();
}

$stmt = $pdo->prepare("SELECT pedidos.*, users.nome AS usuario_nome FROM pedidos INNER JOIN users ON pedidos.user_id = users.id ORDER BY pedidos.id ASC");

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
    <link rel="stylesheet" href="/LaNotte/public/assets/style.css">
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
                        <th>Q.</th> 
                        <th>Prato</th>
                        <th>Preço</th>
                        <th>Alterar Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>

                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td><?= $pedido['usuario_nome'] ?></td>
                            <td><?= $pedido['quantidade'] ?></td>
                            <td><?= $pedido['pedido'] ?></td>
                            <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>

                            <td>
                                <form method="post">
                                    <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">

                                    <select name="status">
                                        <option value="Esperando Confirmação" <?= $pedido['status'] === 'Esperando Confirmação' ? 'selected' : '' ?>>Esperando Confirmação
                                        </option>

                                        <option value="Preparando" <?= $pedido['status'] === 'Preparando' ? 'selected' : '' ?>>Preparando
                                        </option>

                                        <option value="Enviando" <?= $pedido['status'] === 'Enviando' ? 'selected' : '' ?>>Enviando
                                        </option>

                                    </select>

                                    <input type="hidden" name="alterar_status" value="1">
                                </form>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                            <td>
                                <a
                                    href="/LaNotte/public/admin/pedidos/excluir_pedido.php?id=<?= $pedido['id'] ?>"
                                    class="btn-deletar"
                                    onclick="return confirm('Deseja cancelar este pedido? Esta ação não pode ser desfeita.')">
                                    <i class="fa-solid fa-trash"></i>
                                    Cancelar
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