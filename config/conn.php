<?php
require_once __DIR__ . "env.php";

carregar_env(__DIR__ . "/../../.env");

$usuario = $_ENV["DB_USERNAME"];
$senha = $_ENV["DB_PASSWORD"];
$host = $_ENV["DB_HOST"];
$porta = $_ENV["DB_PORT"];
$banco = $_ENV["DB_DATABASE"];

try {
        $pdo = new PDO(
        "mysql:host={$host};port={$porta};dbname={$banco};charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}