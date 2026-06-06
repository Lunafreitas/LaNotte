<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$id = $_GET['id'];

$check = $pdo->prepare("SELECT COUNT(*) FROM produtos WHERE categoria_id = ?");
$check->execute([$id]);

if ($check->fetchColumn() > 0) {
    die('Não é possível excluir esta categoria porque existem produtos vinculados a ela.');
}

$stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
$stmt->execute([$id]);

header('Location: categorias.php');
exit;