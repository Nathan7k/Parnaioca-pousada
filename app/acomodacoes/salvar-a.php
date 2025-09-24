<?php 

    include '../config/conexao.php';



    $tipo_id = $_POST ['tipo_id'];
    $nome = $_POST ['nome'];
    $numero = $_POST ['numero'];
    $valor = $_POST['valor'];
    $capacidade_maxima = $_POST ['capacidade_maxima'];

    $sql = "insert into acomodacoes (tipo_id, nome, numero, valor, capacidade_maxima) values ('$tipo_id', '$nome','$numero', '$valor', '$capacidade_maxima')";

    $query = mysqli_query($con, $sql);

     if ($query) {

        $msg = "acomodação cadastrada com sucesso! ";
        header("Location: cadastrar-a.php?msg=" . urlencode($msg));
    } else {
        $msg = "Erro ao cadastrar acomodação! ";
        header("Location: cadastrar-a.php?msg=" . urlencode($msg));
    }

?>