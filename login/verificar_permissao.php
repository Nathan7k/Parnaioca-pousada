<?php
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}


function verificarPerfil($perfisPermitidos) {
    $perfilUsuario = $_SESSION['perfil'];
    if (!in_array($perfilUsuario, $perfisPermitidos)) {
        echo "<script>alert('Acesso negado!'); history.back();</script>";
        exit;
    }
}
?>
