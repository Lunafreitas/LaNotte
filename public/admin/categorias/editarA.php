<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();
// Pegar ID da URL e validar
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: /public/admin/categorias/categorias.php');
    exit();
}

// Se foi submetido, atualiza a categoria
if (isset($_POST['submit'])) {
    $nome = trim($_POST['nome'] ?? '');
    if ($nome === '') {
        header("Location: /public/admin/categorias/editarA.php?id={$id}");
        exit();
    }

    $stmt = $pdo->prepare('UPDATE categorias SET nome = :nome WHERE id = :id');
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: /public/admin/categorias/categorias.php');
    exit();
}

// Buscar dados da categoria para preencher o formulário
$stmt = $pdo->prepare('SELECT * FROM categorias WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$categoria) {
    header('Location: /public/admin/categorias/categorias.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Editar Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="admin">

<?php include '../../includes/nav_admin.php'; ?>

<div class="form-page">
    <!-- Formulário -->
    <div class="form-conteudo">
        <div class="eyebrow" style="margin-bottom:8px;">Gestão</div>
        <h2 style="margin-bottom:28px;">Editar Categoria</h2>

        <form method="post" class="form-grid">
            <div class="form-campo">
                <label for="nome">Novo Nome *</label>
                <input type="text" id="nome" name="nome" value="<?= $categoria['nome'] ?>" required>
            </div>

            <div class="form-acoes">
                <button type="submit" name="submit" class="btn-form-salvar">
                    <i class="fa-solid fa-check"></i> Salvar
                </button>
                <a href="/public/admin/categorias/categorias.php" class="btn-form-cancelar">
                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>