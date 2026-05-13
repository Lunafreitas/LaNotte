<?php 
require_once 'conn.php';
session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos";
    }

    else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($senha, $user['senha'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome'];

                header("Location: dashboard.php");
                exit();

            } 
            else {
                $erro = "Senha incorreta";
            }

        } 
        else {
            $erro = "Usuário não encontrado";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaNotte - Login</title>
</head>
<body>
    <a href="index.php">Voltar</a>
    
    <?php if(!empty($erro)): ?>
    <div style="color:red; margin-bottom:10px;">
        <?= $erro ?>
    </div>
<?php endif; ?>

    <h1>Seja bem-vindo de volta!</h1>
    <p>Continue usando nossa plataforma para aproveitar o melhor da LaNotte</p>
    <form action="" method="post">
        <label for="email">Email</label><br>
        <input type="email" name="email" placeholder="email@exemplo.com" required><br>

        <label for="senha">Senha</label><br>
        <input type="password" name="senha" placeholder="••••••••" required><br>

        <button type="submit">Entrar</button><br>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </form>
</body>
</html>