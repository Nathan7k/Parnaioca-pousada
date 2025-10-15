<?php

include '../config/conexao.php';
include '../config/functions.php';
session_start();



$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$capacidade_maxima = $_POST['capacidade_maxima'];
$ativo = $_POST['ativo'];


$sql = "UPDATE acomodacoes SET  nome = '$nome', valor ='$valor', capacidade_maxima = '$capacidade_maxima', ativo = '$ativo' WHERE id=$id";

$upAcom = mysqli_query($con, $sql);

if ($upAcom) {
    
    $usuario_id = $_SESSION['usuario_id'] ?? 0;

    registrarLog($con, $usuario_id, "Atualizou a acomodação $nome", "acomodacoes",$id);

    echo "<script>alert('Atualizado com sucesso.'); location.href='listar-a.php';</script>";
} else {

    echo "<script>alert('Erro ao Atualizar.'); location.href='listar-a.php';</script>";
}
