<?php
include '../config/conexao.php';


$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
    die("Acomodação não informada!");
}

$sqlacom = "SELECT nome, numero, valor 
                FROM acomodacoes 
                WHERE id = $acomodacao_id";
$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);



$sqlupcheckin = "UPDATE hospedagens 
                 SET status = 'cancelado' 
                 WHERE acomodacao_id = $acomodacao_id 
                 AND status IN ('reservado','hospedado')";

$resultup = mysqli_query($con, $sqlupcheckin);

$sqlupacom = "UPDATE acomodacoes 
                SET ocupacao = 0 
                WHERE id = $acomodacao_id";
$acomres = mysqli_query($con, $sqlupacom);

$sqlLiberaVaga = "UPDATE estacionamento 
                    SET ocupada = 0 
                    WHERE acomodacao_id = $acomodacao_id 
                    AND ocupada = 1";
mysqli_query($con, $sqlLiberaVaga);

header("location:hospedes.php");

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