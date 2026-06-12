<?php
session_start();

// Verifica se a pessoa está loogada
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login/login.php");
    exit();
} 

// Verifica admin
function verificarAdmin() {
    if ($_SESSION['user_nivel'] != 1) {
        header("Location: ../usuario/dashboard_user.php");
        exit();
    }
}

// Verifica usuário
function verificarUser() {
    if ($_SESSION['user_nivel'] != 0) {
        header("Location: ../admin/dashboard_admin.php");
        exit();
    }
}