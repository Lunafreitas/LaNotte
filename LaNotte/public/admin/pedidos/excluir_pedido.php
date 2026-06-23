<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

header('Location: /public/admin/pedidos/pedidos.php');
exit();