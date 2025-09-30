<?php
include '../config/conexao.php';


$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
    die("Acomodação não informada!");
}

$sqlupcheckin = "UPDATE hospedagens 
                 SET status = 'cancelado' 
                 WHERE acomodacao_id = $acomodacao_id 
                 AND status IN ('reservado','hospedado')";

$resultup = mysqli_query($con, $sqlupcheckin);




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