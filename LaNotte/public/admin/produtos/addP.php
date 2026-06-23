<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $categoria_id = $_POST['categoria_id'];
    $nome         = $_POST['nome'];
    $descricao    = $_POST['descricao'];
    $preco        = $_POST['preco'];
    $disponivel   = $_POST['disponivel'];
    $imagem       = $_FILES['imagem']['name'];

    move_uploaded_file($_FILES['imagem']['tmp_name'], "../../images/" . $imagem);

    $stmt = $pdo->prepare("INSERT INTO produtos (categoria_id, nome, descricao, preco, img_url, disponivel) VALUES (:categoria_id, :nome, :descricao, :preco, :img_url, :disponivel)");
    $stmt->bindValue(':categoria_id', $categoria_id);
    $stmt->bindValue(':nome',         $nome);
    $stmt->bindValue(':descricao',    $descricao);
    $stmt->bindValue(':preco',        $preco);
    $stmt->bindValue(':img_url',      $imagem);
    $stmt->bindValue(':disponivel',   $disponivel);
    $stmt->execute();

    header('Location: /public/admin/produtos/produtos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Adicionar Produto</title>
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
        <div class="eyebrow" style="margin-bottom:8px;">Novo item</div>
        <h2 style="margin-bottom:28px;">Adicionar Produto</h2>

        <form method="post" enctype="multipart/form-data" class="form-grid">
            <div class="form-campo">
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-campo">
                <label for="nome">Nome *</label>
                <input type="text" id="nome" name="nome"
                       placeholder="Ex: Spaghetti alla Carbonara" required
                       oninput="document.getElementById('preview-nome').textContent=this.value||'Nome do produto'">
            </div>

            <div class="form-campo">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descreva o prato..."></textarea>
            </div>

            <div class="form-campo">
                <label for="preco">Preço (R$) *</label>
                <input type="number" id="preco" name="preco" step="0.01" placeholder="0.00" required
                       oninput="document.getElementById('preview-preco').textContent='R$ '+(parseFloat(this.value)||0).toFixed(2).replace('.',',')">
            </div>

            <div class="form-campo">
                <label for="imagem">Imagem *</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" required>
            </div>

            <div class="form-campo">
                <label for="disponivel">Status</label>
                <select id="disponivel" name="disponivel">
                    <option value="Disponível">Disponível</option>
                    <option value="Indisponível">Indisponível</option>
                </select>
            </div>

            <div class="form-acoes">
                <button type="submit" name="submit" class="btn-form-salvar">
                    <i class="fa-solid fa-plus"></i> Adicionar
                </button>
                <a href="/public/admin/produtos/produtos.php" class="btn-form-cancelar">
                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>