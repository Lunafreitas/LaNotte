<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$total_users   = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE nivel = 0")->fetchColumn();
$total_prods   = (int)$pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
$total_cats    = (int)$pdo->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
$total_pedidos = (int)$pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();

$ultimos = $pdo->query("SELECT id, nome, email, img_user FROM users WHERE nivel = 0 ORDER BY id DESC LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="admin">
<?php include '../../includes/nav_admin.php'; ?>

<div class="main">
    <div class="page-header">
        <div>
            <div class="eyebrow">Visão Geral</div>
            <h2>Dashboard <span style="color:var(--amarelo)">Admin</span></h2>
        </div>
        <div style="display:flex;gap:12px;">
            <a href="/public/admin/produtos/produtos.php" class="add" style="background:transparent;color:var(--amarelo);border-color:rgba(248,164,27,.3);">
                <i class="fa-solid fa-utensils"></i> Produtos
            </a>
            <a href="/public/admin/categorias/categorias.php" class="add">
                <i class="fa-solid fa-plus"></i> Nova Categoria
            </a>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card" data-bg="<?= $total_users ?>">
            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stat-num"><?= $total_users ?></div>
            <div class="stat-lbl">Usuários</div>
            <div class="stat-delta"><i class="fa-solid fa-arrow-trend-up"></i> Ativos</div>
        </div>
        <div class="stat-card" data-bg="<?= $total_prods ?>">
            <div class="stat-icon"><i class="fa-solid fa-utensils"></i></div>
            <div class="stat-num"><?= $total_prods ?></div>
            <div class="stat-lbl">Produtos</div>
            <div class="stat-delta" style="color:var(--amarelo)"><i class="fa-solid fa-star"></i> No cardápio</div>
        </div>
        <div class="stat-card" data-bg="<?= $total_cats ?>">
            <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
            <div class="stat-num"><?= $total_cats ?></div>
            <div class="stat-lbl">Categorias</div>
            <div class="stat-delta" style="color:var(--amarelo)"><i class="fa-solid fa-list"></i> Cadastradas</div>
        </div>
        <div class="stat-card" data-bg="<?= $total_pedidos ?>">
            <div class="stat-icon"><i class="fa-solid fa-receipt"></i></div>
            <div class="stat-num"><?= $total_pedidos ?></div>
            <div class="stat-lbl">Pedidos</div>
            <div class="stat-delta" style="color:var(--marrom)"><i class="fa-solid fa-clock"></i> Total</div>
        </div>
    </div>

    <div class="dash-row">
        <div class="acoes-rapidas">
            <div class="acoes-rapidas-topo">Ações Rápidas</div>
            <a href="/public/admin/produtos/produtos.php"       class="acao-item">
                <div class="acao-esq"><div class="acao-icone"><i class="fa-solid fa-utensils"></i></div><div><div class="acao-titulo">Produtos</div><div class="acao-desc">Gerenciar cardápio</div></div></div>
                <i class="fa-solid fa-chevron-right acao-seta"></i>
            </a>
            <a href="/public/admin/categorias/categorias.php"   class="acao-item">
                <div class="acao-esq"><div class="acao-icone"><i class="fa-solid fa-tags"></i></div><div><div class="acao-titulo">Categorias</div><div class="acao-desc">Organizar seções</div></div></div>
                <i class="fa-solid fa-chevron-right acao-seta"></i>
            </a>
            <a href="/public/admin//home/usuarios.php"                class="acao-item">
                <div class="acao-esq"><div class="acao-icone"><i class="fa-solid fa-users"></i></div><div><div class="acao-titulo">Usuários</div><div class="acao-desc">Ver contas</div></div></div>
                <i class="fa-solid fa-chevron-right acao-seta"></i>
            </a>
            <a href="/public/admin/pedidos/pedidos.php"                 class="acao-item">
                <div class="acao-esq"><div class="acao-icone"><i class="fa-solid fa-receipt"></i></div><div><div class="acao-titulo">Pedidos</div><div class="acao-desc">Acompanhar</div></div></div>
                <i class="fa-solid fa-chevron-right acao-seta"></i>
            </a>
        </div>

        <div class="tabela-wrap">
            <div class="tabela-topo">
                <span class="tabela-label">Últimos Usuários</span>
                <a href="/public/admin//home/usuarios.php" class="add" style="padding:6px 14px;font-size:8px;background:transparent;color:var(--amarelo);border-color:rgba(248,164,27,.3);">
                    Ver todos <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ultimos as $ultimo): ?>
                    <tr>
                        <td class="td-img">
                            <?php if (empty($ultimo['img_user'])): ?>
                                <img src="/public/images/semfoto.jpg" alt="Sem foto">
                            <?php else: ?>
                                <img src="/public/images/<?= $ultimo['img_user'] ?>" alt="Foto de perfil">
                            <?php endif; ?>
                        </td>
                        <td class="td-id"><?= $ultimo['id'] ?></td>                            
                        <td class="td-nome"><?= $ultimo['nome'] ?></td>
                            <td><?= $ultimo['email'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
