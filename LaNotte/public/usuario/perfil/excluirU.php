<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    session_destroy();
    // $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    // $stmt->bindValue(':id', $id);
    // $stmt->execute();

    // Excluir avaliações
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE user_id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        //Excluir pedidos
        $stmt = $pdo->prepare("DELETE FROM pedidos WHERE user_id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Excluir usuário
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

    header('Location: ../../../index.php');
    exit();
}
?>