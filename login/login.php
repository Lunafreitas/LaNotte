<?php
require_once '../config/conn.php';

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
    <title>LaNotte - Login</title>
</head>

<body>
    <a href="../index.php">← Voltar</a>
    <h1>Login</h1>
    <?php if (!empty($erro)): ?>
        <p><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="campo">
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div><br>
        <div class="campo">
            <label>Senha</label><br>
            <input type="password" name="senha" required>
        </div><br>
        <button type="submit">Entrar</button>
    </form><br>
    <p>Não tem uma conta?<a href="cadastro.php">Criar conta</a></p>
    
</body>

</html>