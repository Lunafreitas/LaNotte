<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

$id = $_SESSION['user_id'];
$nome_user = $_SESSION['user_nome'];
$email_user = $_SESSION['user_email'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindValue(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM pedidos WHERE user_id = :user_id');
$stmt->bindValue(':user_id', $id);
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
    <title>La Notte — Meu Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="user">

<?php include '../../includes/nav_user.php'; ?>

<div class="perfil-page">
    <div class="perfil-card-topo">
        <img src="/public/images/<?= ($img_user) ?>" alt="Foto de perfil" class="perfil-avatar">

        <div class="perfil-topo-info">
            <div class="perfil-topo-nome"><?= $user['nome'] ?></div>
            <div class="perfil-topo-email"><?= $user['email'] ?></div>
        </div>

        <div class="perfil-topo-acao">
            <a href="/public/usuario/perfil/excluirU.php?id=<?= $user['id'] ?>" class="btn-editar-perfil" style="margin-right: 10px;" onclick="return confirm('Tem certeza que deseja excluir seu perfil? Esta ação não pode ser desfeita.')">
                <i class="fa-solid fa-trash"></i> Excluir Perfil
            </a>
            <a href="/public/usuario/perfil/editarU.php?id=<?= $user['id'] ?>" class="btn-editar-perfil">
                <i class="fa-solid fa-pen-to-square"></i> Editar Perfil
            </a>
        </div>

    </div>

    <div class="perfil-grid-baixo">

        <div class="perfil-bloco">
            <div class="perfil-bloco-topo">
                <span class="perfil-bloco-titulo">Informações Pessoais</span>
            </div>
            <div class="perfil-campos">
                <div class="perfil-campo">
                    <span class="perfil-campo-label">Nome</span>
                    <span class="perfil-campo-valor"><?= $user['nome'] ?></span>
                </div>
                <div class="perfil-campo">
                    <span class="perfil-campo-label">Email</span>
                    <span class="perfil-campo-valor"><?= $user['email'] ?></span>
                </div>
            </div>
        </div>

        <div class="perfil-stat-card">
            <div class="perfil-stat-topo">
                <span class="perfil-stat-titulo">Meus Pedidos</span>
            </div>
            <div class="perfil-stat-corpo">
                <div class="perfil-stat-num"><?= $count_pedidos ?></div>
                <div class="perfil-stat-lbl">Pedido(s) realizado(s)</div>
            </div>
            <a href="/public/usuario/historico/historico.php" class="perfil-stat-link">
                Ver histórico <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>

</div>

</body>
</html>
