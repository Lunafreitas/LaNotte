<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT * FROM categorias");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($categorias);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Categorias</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="admin">
    <?php include '../../includes/nav_admin.php' ?>
    <div>
        <div class="main">

            <!-- Cabeçalho -->
            <div class="page-header">
                <div>
                    <div class="eyebrow">Gestão</div>
                    <h2>Categorias</h2>
                </div>
                <a href="addA.php" class="add">
                    <i class="fa-solid fa-plus"></i> Nova Categoria
                </a>
            </div>

            <!-- Topo da grade -->
            <div class="tabela-topo" style="border:2px solid rgba(248,164,27,.16);border-bottom:0;">
                <span class="tabela-label">Todas as Categorias</span>
                <span class="tabela-count"><?= $total ?> categoria(s)</span>
            </div>

            <!-- Grid de cards -->
            <div class="cats-grid">
                    <?php foreach ($categorias as $categoria): ?>
                        <div class="cat-card" data-id="<?= $categoria['id'] ?>">
                            <div class="cat-nome"><?= $categoria['nome'] ?></div>
                            <div class="cat-meta">
                                Ordem <strong>#<?= $categoria['id'] ?></strong>
                            </div>
                            <div class="cat-acoes">
                                <a href="editarA.php?id=<?= $categoria['id'] ?>" class="btn-editar">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                                <a href="deleteA.php?id=<?= $categoria['id'] ?>"
                                    class="btn-deletar"
                                    onclick="return confirm('Excluir? Esta ação não pode ser desfeita.')">
                                    <i class="fa-solid fa-trash"></i> Excluir
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>

        </div>
</body>

</html>