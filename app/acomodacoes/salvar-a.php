<?php 

    include '../config/conexao.php';



    $tipo_id = $_POST ['tipo_id'];
    $nome = $_POST ['nome'];
    $numero = $_POST ['numero'];
    $valor = $_POST['valor'];
    $capacidade_maxima = $_POST ['capacidade_maxima'];
    $quantidade_vagas = (int) $_POST['quantidade_vagas'];

    $sql = "insert into acomodacoes (tipo_id, nome, numero, valor, capacidade_maxima) values ('$tipo_id', '$nome','$numero', '$valor', '$capacidade_maxima')";

    $query = mysqli_query($con, $sql);

     if ($query) {

        $acomodacao_id = mysqli_insert_id($con);

        for( $i = 1; $i<=$quantidade_vagas; $i++){

            $sqlest = "INSERT INTO estacionamento (acomodacao_id, vaga_numero) VALUES ('$acomodacao_id', '$i')";
            mysqli_query($con, $sqlest);
        }
        $msg = "Acomodação cadastrada com sucesso e vagas criadas! ";
        header("Location: cadastrar-a.php?msg=" . urlencode($msg));
    } else {
        $msg = "Erro ao cadastrar acomodação! ";
        header("Location: cadastrar-a.php?msg=" . urlencode($msg));
    }

?>