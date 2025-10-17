<?php

include '../config/conexao.php';
include '../config/functions.php';
session_start();


$tipo = $_POST['tipo'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$capacidade_maxima = $_POST['capacidade_maxima'];
$quantidade_vagas = (int) $_POST['quantidade_vagas'];

$sql = "insert into acomodacoes (tipo, nome, valor, capacidade_maxima) values ('$tipo', '$nome','$valor', '$capacidade_maxima')";

$query = mysqli_query($con, $sql);

if ($query) {

    $acomodacao_id = mysqli_insert_id($con);

    for ($i = 1; $i <= $quantidade_vagas; $i++) {

        $sqlest = "INSERT INTO estacionamento (acomodacao_id, vaga_numero) VALUES ('$acomodacao_id', '$i')";
        mysqli_query($con, $sqlest);
    }
    $usuario_id = $_SESSION['usuario_id'] ?? 0;
    registrarLog($con, $usuario_id, "Cadastrou a acomodação $nome com $quantidade_vagas vagas", "acomodacoes", $acomodacao_id);

    $msg = "Acomodação cadastrada com sucesso e vagas criadas!";
    header("Location: cadastrar-a.php?msg=" . urlencode($msg));
} else {
    $msg = "Erro ao cadastrar acomodação: " . mysqli_error($con);
    header("Location: cadastrar-a.php?msg=" . urlencode($msg));
}
