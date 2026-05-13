<?php
require_once 'conn.php';
session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Email inválido';
    } elseif (strlen($senha) < 8) {
        $erro = 'A senha deve ter pelo menos 8 caracteres';
    } else {

        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $erro = 'Usuário já cadastrado';
        } else {

            $stmt = $pdo->prepare('
                INSERT INTO users (nome, email, senha)
                VALUES (:nome, :email, :senha)
            ');

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT));

            if ($stmt->execute()) {

                $_SESSION['user_id'] = $pdo->lastInsertId();

                header("Location: index.php");
                exit();
            } else {

                $erro = 'Erro ao cadastrar o usuário';
            }
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
    <a href="index.php">Voltar</a>
    <?php
    if (!empty($erro)):
    ?>
        <div style="color: red; margin-bottom: 10px;">
            <?= $erro ?>
        </div>
    <?php endif; ?>


    <h1>Comece agora!</h1>
    <p>Crie sua conta de graça para aproveitar o melhor da LaNotte</p>
    <form action="" method="post">
        <label for="nome">Nome</label><br>
        <input type="text" name="nome" placeholder="Seu Nome" required><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" placeholder="email@exemplo.com" required><br>

        <label for="senha">Senha</label><br>
        <input type="password" name="senha" placeholder="••••••••" required><br>

        <button type="submit">Cadastrar</button><br>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </form>
</body>

</html>