<?php
include '../config/conexao.php';


$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$ativo = ($_POST['ativo']);

$sql = "UPDATE itens_frigobar 
        SET nome = '$nome', valor = '$valor', ativo='$ativo' 
        WHERE id=$id";
        
if (mysqli_query($con, $sql)) {
    echo "<script>alert('Item atualizado com sucesso'); history.back();</script>";
} else {
    echo "<script>alert('Erro ao atualizar item'); history.back();</script>";
}
