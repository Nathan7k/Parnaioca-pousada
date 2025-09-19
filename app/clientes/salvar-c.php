<?php
    include '../config/conexao.php';
    include '../config/functions.php';

    
    

    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];

    
validardados_clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade);
  
?>
