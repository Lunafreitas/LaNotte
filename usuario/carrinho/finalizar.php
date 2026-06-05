<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if (isset($_POST['submit'])) {

    if (empty($_POST['total']) || empty($_POST['pedido'])) {
        die('Dados do pedido não enviados.');
    }

    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];
    $pedido = $_POST['pedido'];
    $quantidade = $_POST['quantidade'] ?? 0;

    $status = 'Esperando Confirmação';

    $stmt = $pdo->prepare("
        INSERT INTO pedidos 
        (user_id, status, preco, pedido, quantidade) 
        VALUES 
        (:user_id, :status, :total, :pedido, :quantidade)
    ");

    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':status', $status);
    $stmt->bindValue(':total', $total);
    $stmt->bindValue(':pedido', $pedido);
    $stmt->bindValue(':quantidade', $quantidade);

    $stmt->execute();

    $stmt = $pdo->prepare("
        DELETE FROM carrinho 
        WHERE user_id = :user_id
    ");

    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    header('Location: /LaNotte/public/usuario/carrinho/carrinho.php');
    exit();
}
?>