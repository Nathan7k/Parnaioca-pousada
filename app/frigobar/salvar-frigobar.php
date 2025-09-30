<?php 

    include '../config/conexao.php';



    $tipo_id = $_POST ['tipo_id'];
    $nome = $_POST ['nome'];;
    $valor = $_POST['valor'];

    $sql = "insert into itens_frigobar (nome, valor) values ('$nome','$valor')";

    $query = mysqli_query($con, $sql);

     if ($query) {

        $msg = "item cadastrado com sucesso! ";
        header("Location: cadastrar-frigobar.php?msg=" . urlencode($msg));
    } else {
        $msg = "Erro ao cadastrar item! ";
        header("Location: cadastrar-frigobar.php?msg=" . urlencode($msg));
    }

?>