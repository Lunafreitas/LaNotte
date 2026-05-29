<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");

    $stmt->bindValue(':id', $id);
    $stmt->execute();

    session_destroy();
    header('Location: ../../index.php');
    exit();
}
?>