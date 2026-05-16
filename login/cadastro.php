<?php
require_once '../config/conn.php';

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
            $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha, nivel) VALUES (?, ?, ?, 0)");
            $stmt->execute([$nome, $email, $senhaHash]);
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
    <title>LaNotte - Cadastro</title>
</head>

<body>

    <a href="../index.php">← Voltar</a>

    <?php if ($erro): ?>
        <p><?= $erro ?></p>
    <?php endif; ?>

    <div>
        <h1>La<span>Notte</span></h1>
        <p>Crie sua conta gratuita</p>

        <form action="" method="post">
            <div>
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <br>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div>
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <br>
            <div>
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <br>
            <button type="submit">Criar Conta</button>
        </form>
        <br>
        <div>
            <p>Já tem uma conta?<a href="login.php">Faça login</a></p>
        </div>

    </div>

</body>

</html>