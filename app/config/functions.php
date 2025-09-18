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
        $msg =  "Todos os campos são obrigatórios.";
        return $msg;
    }

    if (strlen($nome) < 3) {
        $msg =  "O nome deve ter pelo menos 3 caracteres.";
        return $msg;
    }
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $nome)) {
        $msg =  "O nome só pode conter letras e espaços.";
        return $msg;
    }

    $sql = "SELECT id FROM clientes WHERE cpf='$cpf'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $msg =  "Este CPF já está cadastrado.";
        return $msg;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg =  "email inválido.";
        return $msg;
    }

    return true;
}








  

