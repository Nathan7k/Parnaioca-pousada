<?php
    include '../config/conexao.php';
    include '../functions.php';

    $id = $_POST['id'];
    
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $ativo = isset($_POST['stat']) ? 1 : 0;

    updatecliente ($con, $id, $nome, $data_nascimento, $email, $telefone, $estado, $cidade, $ativo);

?>