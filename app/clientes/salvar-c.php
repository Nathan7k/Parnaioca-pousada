<?php
session_start();
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


$id_cliente = insert_Clientes($con, $nome, $data_nascimento, $cpf, $email, $telefone, $estado, $cidade);

if ($id_cliente) {
    $usuario_id = $_SESSION['usuario_id'] ?? 0;

   
    registrarLog($con, $usuario_id, "Cadastrou o cliente $nome", "clientes", $id_cliente);

    $msg = "Cliente cadastrado com sucesso!";
    header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
    exit;

} else {
    
    $msg = "Erro ao cadastrar cliente!";
    header("Location: cadastrar-clientes.php?msg=" . urlencode($msg));
    exit;
}
