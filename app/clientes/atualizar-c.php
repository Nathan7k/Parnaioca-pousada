<?php
session_start();
include '../config/conexao.php';
include '../config/functions.php';

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$data_nascimento = $_POST['data_nascimento'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$estado = $_POST['estado'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$ativo = isset($_POST['ativo']) ? 1 : 0;

$result = updatecliente($con, $id, $nome, $data_nascimento, $email, $telefone, $estado, $cidade, $ativo);

if ($result === true) {
    $usuario_id = $_SESSION['usuario_id'];
    registrarLog($con, $usuario_id, "Atualizou o cadastro do cliente $nome", "clientes", $id);
    echo "<script>alert('Cliente atualizado com sucesso.'); window.location.href = 'listar-c.php';</script>";
    exit;
} else {
    echo "Erro ao atualizar cliente.";
}
