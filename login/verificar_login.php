<?php
session_start();
include '../app/config/config.php';
include '../app/config/conexao.php';
include '../app/config/functions.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']); 


$sql = "SELECT * FROM funcionarios WHERE email = '$email' AND ativo = 1";
$result = mysqli_query($con, $sql);
$usuario = mysqli_fetch_assoc($result);

if ($usuario && $usuario['senha'] === $senha ) {
    
    $_SESSION['perfil'] = $usuario['perfil'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['usuario_id'] = $usuario['id'];

  
    registrarLog($con, $usuario['id'], "Login realizado com sucesso", "login", $usuario['id']);

    header('Location: ../app/funcionarios/home.php');
    exit;
} else {
    
    $msg = "Usuário ou senha inválidos";
    session_destroy();
    header("Location: ../index.php?msg=" . urlencode($msg));
    exit;
}
