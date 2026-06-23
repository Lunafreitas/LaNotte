<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if (isset($_GET['id'])) {

    $produto_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Busca produto
    $produto = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");

    $produto->execute([$produto_id]);
    $dadosProduto = $produto->fetch(PDO::FETCH_ASSOC);

    $preco = $dadosProduto['preco'];
    $stmt = $pdo->prepare("SELECT id FROM carrinho WHERE user_id = ? AND produto_id = ?");
    $stmt->execute([$user_id, $produto_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Soma quantidade
        $update = $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = ?");
        $update->execute([$item['id']]);
    } else {
        // Insere item
        $insert = $pdo->prepare("INSERT INTO carrinho(user_id, produto_id, quantidade, preco) VALUES (?, ?, 1, ?)");
        $insert->execute([$user_id, $produto_id, $preco]);
    }

    header("Location: /public/usuario/cardapio/cardapio.php");
    exit;
}
?>