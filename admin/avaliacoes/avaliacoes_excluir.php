<?php
require_once '../../config/conn.php';
require_once '../login/autenticacao.php';

verificarAdmin();

if (isset($_GET['excluir'])) {
    $review_id = (int) $_GET['excluir'];
    if ($review_id > 0) {
        $delete = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
        $delete->bindValue(':id', $review_id, PDO::PARAM_INT);
        $delete->execute();
    }

    header('Location: /LaNotte/public/admin/avaliacoes/avaliacoes_excluir.php');
    exit();
}

$stmt = $pdo->query("SELECT r.id AS review_id, r.user_id, r.nota, r.comentario, r.data, r.img_user, u.nome AS user_nome, u.img_user AS user_img FROM reviews r INNER JOIN users u ON r.user_id = u.id ORDER BY r.id DESC");

$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_avaliacoes = count($avaliacoes);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Avaliações</title>
    <link rel="stylesheet" href="/LaNotte/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="admin">

    <?php include '../../includes/nav_admin.php'; ?>

<div class="main">
    <div class="page-header">
        <div>
            <div class="eyebrow">Gestão</div>
            <h2>Gerencie as avaliações</h2>
        </div>
    </div>

    <div class="tabela-topo" style="border:2px solid rgba(248,164,27,.16);border-bottom:0;">
        <span class="tabela-label">Todas as Avaliações</span>
        <span class="tabela-count"><?= $total_avaliacoes ?> avaliação(es)</span>
    </div>

    <div class="cats-grid" style="grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));">
        <?php if (!empty($avaliacoes)): ?>
            <?php foreach ($avaliacoes as $avaliacao): ?>
                <div class="avaliacao-card">
                    <div class="avaliacao-topo">
                        <img src="/LaNotte/images/<?= !empty($avaliacao['user_img']) ? $avaliacao['user_img'] : 'semfoto.jpg' ?>" alt="<?= $avaliacao['user_nome'] ?>" class="avaliacao-avatar">
                        <strong style="color: var(--amarelo); font-size: 18px"><?= $avaliacao['user_nome'] ?></strong>

                        <span style="color: var(--amarelo);"><?= date('d/m/Y', strtotime($avaliacao['data'])) ?></span>
                    </div>

                    <!-- Estrelas -->
                    <div class="avaliacao-nota">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="<?= $i <= $avaliacao['nota'] ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="avaliacao-texto" style="color: rgba(255, 255, 255, .65);"><?= $avaliacao['comentario'] ?></p>
                        <div class="avaliacao-acoes">                
                            <a href="/LaNotte/public/admin/avaliacoes/avaliacoes_excluir.php?excluir=<?= $avaliacao['review_id']; ?>" class="btn-av-excluir" onclick="return confirm('Excluir esta avaliação? Esta ação não pode ser desfeita.')"> <i class="fa-solid fa-trash"></i> Excluir </a>
                        </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="carrinho-vazio">
                <p>Nenhuma avaliação ainda. Seja o primeiro a avaliar!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>

</html>