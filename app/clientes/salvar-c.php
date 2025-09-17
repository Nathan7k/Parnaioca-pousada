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

    
    $validardados = validardados_clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade);
    if($validardados == true){
        insert_Clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade);
    } else {   
        $msg = "Erro ao cadastrar cliente! ({$validardados})";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
    }
?>