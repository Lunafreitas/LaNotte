<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Área do Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="user">

<?php include '../../includes/nav_user.php'; ?>

<div class="dash-user-page">

    <!--  Hero de boas-vindas  -->
    <div class="dash-hero">
        <div>
            <div class="dash-hero-tag">Bem-vindo de volta</div>
            <div class="dash-hero-nome">
                Olá,
                <span><?= explode(' ', $_SESSION['user_nome'])[0] ?></span>
            </div>
            <p class="dash-hero-sub">
                Acesse o cardápio, acompanhe seus pedidos e aproveite os benefícios exclusivos da La Notte.
            </p>
        </div>
        <a href="../../login/logout.php" class="dash-hero-sair">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </div>

    <!-- ── Grid de acesso rápido ── -->
    <div class="dash-grid">

        <a href="../cardapio/cardapio.php" class="dash-card" data-n="01">
            <i class="fa-solid fa-utensils dash-card-icon"></i>
            <div class="dash-card-titulo">Cardápio</div>
            <p class="dash-card-desc">Explore todos os pratos, pizzas e sobremesas da La Notte.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../carrinho/carrinho.php" class="dash-card" data-n="02">
            <i class="fa-solid fa-bag-shopping dash-card-icon"></i>
            <div class="dash-card-titulo">Carrinho</div>
            <p class="dash-card-desc">Veja os itens que você adicionou e finalize seu pedido.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../historico/historico.php" class="dash-card" data-n="03">
            <i class="fa-solid fa-receipt dash-card-icon"></i>
            <div class="dash-card-titulo">Meus Pedidos</div>
            <p class="dash-card-desc">Acompanhe o histórico e status dos seus pedidos anteriores.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../perfil/perfilU.php" class="dash-card" data-n="04">
            <i class="fa-solid fa-user dash-card-icon"></i>
            <div class="dash-card-titulo">Meu Perfil</div>
            <p class="dash-card-desc">Edite seus dados, foto de perfil e informações da conta.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../avaliacoes/avaliacoes.php" class="dash-card" data-n="05">
            <i class="fa-solid fa-star dash-card-icon"></i>
            <div class="dash-card-titulo">Avaliações</div>
            <p class="dash-card-desc">Leia o que outros clientes disseram e deixe a sua opinião.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../cardapio/cardapio.php" class="dash-card" data-n="06">
            <i class="fa-solid fa-heart dash-card-icon"></i>
            <div class="dash-card-titulo">Favoritos</div>
            <p class="dash-card-desc">Acesse rapidamente os pratos que você mais gosta.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <a href="../../../index.php" class="dash-card" data-n="07">
            <i class="fa-solid fa-globe dash-card-icon"></i>
            <div class="dash-card-titulo">Ver Site</div>
            <p class="dash-card-desc">Volte à página inicial da La Notte.</p>
            <i class="fa-solid fa-arrow-right dash-card-seta"></i>
        </a>

        <!-- Card decorativo com email do usuário -->
        <div class="dash-card" data-n="08" style="cursor:default;">
            <i class="fa-solid fa-envelope dash-card-icon" style="color:var(--marrom);"></i>
            <div class="dash-card-titulo" style="font-size:18px;line-height:1.3;word-break:break-all;">
                <?= $_SESSION['user_email'] ?>
            </div>
            <p class="dash-card-desc">Conta ativa</p>
        </div>

    </div>

</div>

</body>
</html>
