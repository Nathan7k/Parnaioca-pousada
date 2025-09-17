<?php
date_default_timezone_set("America/Sao_Paulo");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config/conexao.php';
include '../config/functions.php';

validardados_funcionarios($nome, $email, $senha, $perfil);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $perfil = $_POST['perfil'];

    $result = insertFuncionario($con, $nome, $email, $senha, $perfil);

    if ($result === true) {
        $msg = "Funcionário cadastrado com sucesso!";
        header("Location: cadastrar-f.php?msg=" . urlencode($msg));
        exit;
    } else {
        echo $result;
    }
} else {
    echo "Método inválido.";
}
