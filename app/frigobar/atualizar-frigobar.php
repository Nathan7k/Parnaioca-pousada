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
    echo "Item atualizado com sucesso";
} else {
    echo "Erro ao atualizar; " . mysqli_error($con);
}
