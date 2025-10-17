<?php
include '../config/conexao.php';
include  '../config/functions.php';
session_start();

$acomodacao_id = $_GET['acomodacao_id'] ?? 0;

if (!$acomodacao_id) {
    die("Acomodação não informada!");
}

$sqlacom = "SELECT nome, numero, valor 
                FROM acomodacoes 
                WHERE id = $acomodacao_id";

$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);

if (!$acomodacao) {

    die("<script>alert('Acomodação não encontrada.'); history.back();</script>");
}

$sqlupcheckin = "UPDATE hospedagens 
                 SET status = 'cancelado' 
                 WHERE acomodacao_id = $acomodacao_id 
                 AND status IN ('reservado')";

$resultup = mysqli_query($con, $sqlupcheckin);

if ($resultup && mysqli_affected_rows($con) > 0) {

    $sqlupacom = "UPDATE acomodacoes 
                SET ocupacao = 0 
                WHERE id = $acomodacao_id";

    $acomres = mysqli_query($con, $sqlupacom);

    $sqlLiberaVaga = "UPDATE estacionamento 
                    SET ocupada = 0 
                    WHERE acomodacao_id = $acomodacao_id 
                    AND ocupada = 1";

    mysqli_query($con, $sqlLiberaVaga);


    if ($acomres) {

        $usuario_id = $_SESSION['usuario_id'] ?? 0;
        $nome = $acomodacao['nome'];


        registrarLog($con, $usuario_id, "Cancelou a reserva $nome", "hospedagens", $acomodacao_id);


        echo "<script>alert('Reserva cancelada com sucesso.'); window.location.href='hospedes.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar acomodação.'); history.back();</script>";
    }
} else {
    echo "<script>alert('Nenhuma reserva com status Reservado encontrada.'); history.back();</script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>