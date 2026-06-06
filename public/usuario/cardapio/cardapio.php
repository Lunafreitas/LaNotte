<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

$stmt = $pdo->query(
  "SELECT produtos.*, categorias.nome AS categoria_nome FROM produtos LEFT JOIN categorias ON produtos.categoria_id = categorias.id ORDER BY categorias.nome, produtos.nome"
);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Notte — Cardápio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/assets/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="user">

  <?php include '../../includes/nav_user.php'; ?>

  <section class="cardapio-user" id="cardapio">

    <div class="cardapio-user-header">
      <div>
        <span class="section-tag">Cada prato feito com amor</span>
        <h2 class="section-h2">Nosso Cardápio</h2>
      </div>
      <a href="/public/usuario/carrinho/carrinho.php" class="carrinho-link">
        <i class="fa-solid fa-cart-shopping"></i>
        Carrinho
      </a>
    </div>

    <div class="menu-grid-4">
      <?php foreach ($produtos as $produto):
        $disponivel = ($produto['disponivel'] == 'Disponível');
      ?>
        <div class="menu-card-4 <?= !$disponivel ? 'indisponivel' : '' ?>">

          <div class="card4-img-wrap">
            <img src="../../images/<?= $produto['img_url'] ?>" alt="<?= $produto['nome'] ?>" class="card4-img">

            <?php if (!$disponivel): ?>
              <div class="card4-indisponivel-overlay">Indisponível</div>
            <?php endif; ?>
          </div>

          <!-- Corpo do card -->
          <div class="card4-body">
            <!-- Tag de categoria -->
            <span class="menu-tag"><?= $produto['categoria_nome'] ?></span>

            <h3 class="card4-nome"><?= $produto['nome'] ?></h3>
            <p class="card4-desc"><?= $produto['descricao'] ?></p>
          </div>

          <div class="card4-footer">
            <span class="menu-price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>

            <!-- os botões -->
            <?php if ($disponivel): ?>
              <a href="/public/usuario/cardapio/add_carrinho.php?id=<?= $produto['id'] ?>" class="btn-carrinho">
                <i class="fa-solid fa-plus"></i>
                Adicionar
              </a>
            <?php else: ?>
              <button type="button" class="btn-carrinho btn-carrinho-off" disabled aria-disabled="true">
                <i class="fa-solid fa-ban"></i>
                Indisponível
              </button>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <?php if (empty($produtos)): ?>
        <div class="cardapio-vazio">
          <i class="fa-solid fa-utensils"></i>
          <p>Nenhum produto disponível no momento.</p>
        </div>
      <?php endif; ?>
    </div>

  </section>

</body>

</html>