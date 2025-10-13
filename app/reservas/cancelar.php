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

if(!$acomodacao){
    die ("<script>alert('Acomodação não encontrada.'); history.back();</script>");
}



$sqlupcheckin = "UPDATE hospedagens 
                 SET status = 'cancelado' 
                 WHERE acomodacao_id = $acomodacao_id 
                 AND status IN ('reservado')";

$resultup = mysqli_query($con, $sqlupcheckin);

if($resultup && mysqli_affected_rows($con) > 0){



$sqlupacom = "UPDATE acomodacoes 
                SET ocupacao = 0 
                WHERE id = $acomodacao_id";

$acomres = mysqli_query($con, $sqlupacom);

$sqlLiberaVaga = "UPDATE estacionamento 
                    SET ocupada = 0 
                    WHERE acomodacao_id = $acomodacao_id 
                    AND ocupada = 1";

mysqli_query($con, $sqlLiberaVaga);

echo "<script>alert('Reserva cancelada com sucesso.'); window.location.href='hospedes.php';</script>";
exit;

} else {
    echo "<script>alert('Para cancelar é necessário que o status esteja como Reservado.'); history.back();</script>";
exit;

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