<?php
require_once '../../config/conn.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar_senha'];

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar)) {
        $erro = 'Preencha todos os campos';
    } elseif (strlen($senha) < 8) {
        $erro = 'A senha deve conter pelo menos 8 caracteres';
    } elseif ($senha !== $confirmar) {
        $erro = 'As senhas precisam ser iguais';
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $erro = 'Usuário já existente';
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            $img_padrao = 'semfoto.jpg';

            $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha, nivel, img_user) VALUES (?, ?, ?, 0, ?)");

            $stmt->execute([
                $nome,
                $email,
                $senhaHash,
                $img_padrao
            ]);
            header('Location: login.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="auth">

    <a href="../../index.php" class="auth-back">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>

    <div class="auth-box">

        <a href="/LaNotte/index.php" class="auth-logo">La<span>Notte</span>.</a>

        <h1 class="auth-titulo">Cadastro</h1>
        <p class="auth-sub">Crie sua conta gratuita e aproveite.</p>

        <?php if ($erro): ?>
            <div class="auth-erro">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" class="auth-form" novalidate>
            <div class="auth-campo">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome">
            </div>
            <div class="auth-campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@exemplo.com">
            </div>
            <div class="auth-campo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••">
            </div>
            <div class="auth-campo">
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Repita a senha">
            </div>
            <button type="submit" class="auth-btn">Criar Conta</button>
        </form>

        <div class="auth-ou"><span>ou</span></div>

        <div class="auth-rodape">
            <p>Já tem uma conta?</p>
            <a href="../login/login.php">Fazer login</a>
        </div>

    </div>

</body>

</html>