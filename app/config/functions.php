<?php

function insertFuncionario($con, $nome, $email, $senha, $perfil)
{
    $nome = mysqli_real_escape_string($con, $nome);
    $email = mysqli_real_escape_string($con, $email);
    $senha = mysqli_real_escape_string($con, $senha);
    $perfil = mysqli_real_escape_string($con, $perfil);

    $sql = "INSERT INTO funcionarios (nome, email, senha, perfil) 
            VALUES ('$nome', '$email', '$senha', '$perfil')";

    if (mysqli_query($con, $sql)) {
        return true;
    } else {

        return "Erro ao cadastrar funcionário: " . mysqli_error($con);
    }
}





function validardados_funcionarios($nome, $email, $senha, $perfil)
{
    if (empty($nome) || empty($email) || empty($senha) || empty($perfil)) {
        echo "Todos os campos são obrigatórios.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de email inválido.";
    }
}




function updateFuncionario($con, $id, $nome, $email, $senha, $perfil, $ativo)
{

    $sql = "UPDATE funcionarios SET nome='$nome', senha = '$senha',email='$email', perfil='$perfil', Stat='$ativo' WHERE id=$id";



    if (mysqli_query($con, $sql)) {
        echo "Funcionário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar funcionário: " . mysqli_error($con);
    }
}

function updatecliente($con, $id, $nome, $data_nascimento, $email, $telefone, $estado, $cidade, $ativo)
{

    $sql = "UPDATE clientes SET nome='$nome', data_nascimento = '$data_nascimento', email='$email', telefone ='$telefone', estado = '$estado', cidade = '$cidade' ativo ='$ativo' WHERE id=$id";

    if (mysqli_query($con, $sql)) {
        echo "Cliente atualizado com sucesso";
    } else {
        echo "Erro ao atualizar Cliente; " . mysqli_error($con);
    }
}



function insert_Clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade)
{


    $sql = "INSERT INTO clientes (nome, data_nascimento, cpf, email, telefone, estado, cidade) values ('$nome','$data_nascimento','$cpf','$email','$telefone','$estado', '$cidade')";

    $query = (mysqli_query($con, $sql));

    if ($query) {

        $msg = "cliente cadastrado com sucesso! ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
    } else {
        $msg = "Erro ao cadastrar cliente! ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
    }
}

function validardados_clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade)
{

    if (empty($nome) || empty($data_nascimento) || empty($cpf) || empty($email) || empty($telefone) || empty($estado) || empty($cidade)) {
         $msg = "todos os campos são obrigatórios ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
        return false;
    }

    if (strlen($nome) < 3) {
        $msg = "o nome deve ter pelo menos 8 caracteres ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
        return false;
    }
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $nome)) {
         $msg = "o nome só pode conter letras ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
        return false;
    }

    $sql = "SELECT cpf FROM clientes WHERE cpf='$cpf'";
    $res = mysqli_query($con, $sql);
    $numrows = mysqli_num_rows($res);
    
    
    if ($numrows >= 1) {
        $msg = "o CPF informado já está cadastrado ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
        return False;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $msg = "email inválido";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
        return false;
    }

    insert_Clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade);
     $msg = "Cliente cadastrado com sucesso ";
        header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));

    return true;
}
