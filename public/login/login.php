<?php
require_once '../../config/conn.php';

session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_nivel'] = $user['nivel'];

            if ($user['nivel'] == 1) {
                header("Location: ../admin/dashboard_admin.php");
            } else {
                header("Location: ../usuario/dashboard_user.php");
            }
            exit();
        } else {
            $erro = "Email ou senha inválidos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Entrar</title>
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

        <h1 class="auth-titulo">Entrar</h1>
        <p class="auth-sub">Insira suas credenciais para continuar.</p>

        <?php if (!empty($erro)): ?>
            <div class="auth-erro">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form method="post" class="auth-form" novalidate>
            <div class="auth-campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@exemplo.com" required autocomplete="email">
            </div>
            <div class="auth-campo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••">
            </div>
            <button type="submit" class="auth-btn">Entrar</button>
        </form>

        <div class="auth-ou"><span>ou</span></div>

        <div class="auth-rodape">
            <p>Não tem uma conta?</p>
            <a href="../login/cadastro.php">Criar conta</a>
        </div>

    </div>

</body>
</html>