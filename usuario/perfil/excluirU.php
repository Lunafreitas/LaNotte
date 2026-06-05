<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    session_destroy();
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: /LaNotte/public/index.php');
    exit();
}
?>