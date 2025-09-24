<?php 

    include '../config/conexao.php';


    $id = $_POST['id'];
    $tipo_id = $_POST ['tipo_id'];
    $nome = $_POST ['nome'];
    $numero = $_POST ['numero'];
    $valor = $_POST['valor'];
    $capacidade_maxima = $_POST ['capacidade_maxima'];
    $ativo = $_POST['ativo'];


     $sql = "UPDATE acomodacoes SET tipo_id = '$tipo_id', nome = '$nome', numero='$numero', valor ='$valor', capacidade_maxima = '$capacidade_maxima', ativo = '$ativo' WHERE id=$id";

    if (mysqli_query($con, $sql)) {
        echo "Cliente atualizado com sucesso";
    } else {
        echo "Erro ao atualizar Cliente; " . mysqli_error($con);
    }