<?php
    include '../config/conexao.php';
    include '../config/functions.php';

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $perfil = $_POST['perfil'];
    $ativo = isset($_POST['stat']) ? 1 : 0;

    updateFuncionario($con, $id, $nome, $email, $senha, $perfil, $ativo);

?>