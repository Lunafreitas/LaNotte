<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if (!isset($_GET['id'])) {
    header('Location: perfilU.php');
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: perfilU.php');
    exit();
}

if (isset($_POST['submit'])) {
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $img_user = $user['img_user'] ?? null;

    if (!empty($_FILES['imagem']['name'])) {
        $novaImagem = basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../../images/" . $novaImagem);
        $img_user = $novaImagem;
    }

    $stmt = $pdo->prepare("UPDATE users SET nome = :nome, email = :email, img_user = :img_user WHERE id = :id");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':img_user', $img_user);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: perfilU.php');
    exit();
}

$imagemAtual = !empty($user['img_user']) ? $user['img_user'] : 'semfoto.jpg';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Editar Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/LaNotte/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="user">

<?php include '../../includes/nav_user.php'; ?>

<div class="editar-page">
    <div class="editar-card-topo">

        <img src="/LaNotte/images/<?= $imagemAtual ?>"alt="Foto de perfil" class="perfil-avatar">

        <div class="editar-topo-info">
            <div class="editar-topo-nome"><?= $user['nome'] ?></div>
            <div class="editar-topo-sub">Atualize suas informações abaixo</div>
        </div>

    </div>

    <div class="editar-card-form">
        <div class="editar-form-topo">
            <span class="editar-form-titulo">Dados da Conta</span>
        </div>

        <form
            method="post"
            action="editarU.php?id=<?= urlencode($id) ?>"
            enctype="multipart/form-data"
            class="editar-form" id="editar-form-id"
        >
            <div class="editar-campo">
                <label for="nome">Nome</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= $user['nome'] ?>"
                    required
                >
            </div>

            <div class="editar-campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= $user['email'] ?>"
                    required
                >
            </div>

            <div class="editar-campo">
                <label for="imagem">Nova foto de perfil</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
            </div>

        </form>

        <div class="editar-acoes">
            <button type="submit" name="submit" form="editar-form-id" class="btn-salvar">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
            <a href="perfilU.php" class="btn-voltar-perfil">
                <i class="fa-solid fa-arrow-left"></i> Cancelar
            </a>
        </div>

    </div>

</div>

</body>
</html>
