<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");

    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: pedidos.php');
    exit();
}
?>