<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $acao = $_POST['acao'] ?? null;

    if ($id && $acao) {
        if ($acao === 'aumentar') {
            $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $user_id]);
        } elseif ($acao === 'diminuir') {
            $stmt = $pdo->prepare("SELECT quantidade FROM carrinho WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $user_id]);
            $quantidadeAtual = (int) $stmt->fetchColumn();

            if ($quantidadeAtual <= 1) {
                $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id = ? AND user_id = ?");
                $stmt->execute([$id, $user_id]);
            } else {
                $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = quantidade - 1 WHERE id = ? AND user_id = ?");
                $stmt->execute([$id, $user_id]);
            }
        } elseif ($acao === 'excluir') {
            $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $user_id]);
        }
    }

    header('Location: /public/usuario/carrinho/carrinho.php');
    exit();
}

$stmt = $pdo->prepare("SELECT c.id, c.quantidade, p.nome, p.preco, p.img_url FROM carrinho c INNER JOIN produtos p ON c.produto_id = p.id WHERE c.user_id = ? ORDER BY c.id ASC");

$stmt->execute([$user_id]);

$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
$total_itens = 0;
$nomesPedido = [];

foreach ($itens as $item) {
    $subtotal = $item['preco'] * $item['quantidade'];
    $total += $subtotal;
    $total_itens += $item['quantidade'];
    $nomesPedido[] = $item['nome'];
}

$pedidoTexto = implode(', ', $nomesPedido);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Meu Carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="user">
    <?php include '../../includes/nav_user.php'; ?>

    <div class="cardapio-user-header">
        <div>
            <span class="section-tag">Revise antes de confirmar</span>
            <h2 class="section-h2">Meu Carrinho</h2>
        </div>
    </div>

    <?php if (empty($itens)): ?>

        <div class="carrinho-vazio">
            <i class="fa-solid fa-cart-shopping"></i>
            <p class="carrinho-vazio-txt">Seu carrinho está vazio</p>

            <a href="/public/usuario/cardapio/cardapio.php" class="btn-voltar-cardapio"><i class="fa-solid fa-arrow-left"></i>Ver Cardápio</a>
        </div>

    <?php else: ?>
        <div class="carrinho-layout">
            <div class="carrinho-tabela-wrap">
                <div class="carrinho-tabela-topo">
                    <span class="carrinho-tabela-label">Itens do Pedido</span>
                </div>
                <table class="carrinho-tabela">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço Uni.</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td class="carrinho-td-produto">
                                    <?php if (!empty($item['img_url'])): ?>
                                        <img src="../../images/<?= $item['img_url'] ?>" alt="<?= $item['nome'] ?>" class="carrinho-thumb">
                                    <?php endif; ?>

                                    <span class="carrinho-nome"><?= $item['nome'] ?></span>
                                </td>

                                <td class="carrinho-td-preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>

                                <td class="carrinho-td-qtd">
                                    <div class="qtd-controle">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="acao" value="diminuir">
                                            <button type="submit" class="qtd-btn"><i class="fa-solid fa-minus"></i></button>
                                        </form>

                                        <span class="qtd-valor">
                                            <?= $item['quantidade'] ?>
                                        </span>

                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="acao" value="aumentar">
                                            <button type="submit" class="qtd-btn"> <i class="fa-solid fa-plus"></i></button>
                                        </form>
                                    </div>
                                </td>

                                <td class="carrinho-td-subtotal">R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>

                                <td class="carrinho-td-excluir">
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                        <input type="hidden" name="acao" value="excluir">

                                        <button type="submit" class="btn-excluir-item"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="carrinho-resumo">
                <div class="resumo-topo">
                    <span class="resumo-label">Resumo do Pedido</span>
                </div>

                <div class="resumo-linhas">
                    <div class="resumo-linha">
                        <span>Subtotal (<?= $total_itens ?> item(s))</span>

                        <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                    </div>

                    <div class="resumo-linha resumo-linha-destaque">
                        <span>Total</span>

                        <span class="resumo-total">
                            R$ <?= number_format($total, 2, ',', '.') ?>
                        </span>
                    </div>
                </div>

                <form id="formFinalizar" method="post" action="/public/usuario/carrinho/finalizar.php">
                    <input type="hidden" name="total" value="<?= $total ?>">

                    <input type="hidden" name="pedido" value="<?= $pedidoTexto ?>">

                    <input type="hidden" name="quantidade" value="<?= $total_itens ?>">

                    <button type="submit" class="btn-finalizar" name="submit">
                        Finalizar Pedido<i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>

    <?php endif; ?>

    <div id="minhaMensagem" class="mensagem">Pedido finalizado!</div>

    <script>
        const form = document.getElementById('formFinalizar');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const mensagem = document.getElementById('minhaMensagem');
                mensagem.classList.add('mostrar');

                setTimeout(() => {
                    mensagem.classList.remove('mostrar');

                    // envia o formulário de verdade
                    HTMLFormElement.prototype.submit.call(form);
                }, 2000);
            });
        }
    </script>
</body>

</html>