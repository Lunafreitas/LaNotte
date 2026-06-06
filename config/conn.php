<?php

try {
    $pdo = new PDO(
        "mysql:host=banco;port=3306;dbname=lanotte;charset=utf8mb4",
        "lanotte",
        "lanotte123"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}