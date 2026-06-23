<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if (isset($_POST['submit'])) {
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare('INSERT INTO categorias (nome) VALUES (:categoria)');
    $stmt->bindValue(':categoria', $categoria);
    $stmt->execute();
    header('Location: /LaNotte/public/admin/categorias/categorias.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Nova Categoria</title>
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
        <h2 style="margin-bottom:28px;">Nova Categoria</h2>

        <form method="post" class="form-grid">
            <div class="form-campo">
                <label for="categoria">Nome da Categoria *</label>
                <input type="text" id="categoria" name="categoria"
                       placeholder="Ex: Massas, Pizzas, Sobremesas..."
                       required>
            </div>
            <div class="form-acoes">
                <button type="submit" name="submit" class="btn-form-salvar">
                    <i class="fa-solid fa-plus"></i> Adicionar
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
