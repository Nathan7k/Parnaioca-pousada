<?php
include '../config/conexao.php';


$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
  die("Acomodação não informada!");
}

$sqlupcheckin = "UPDATE hospedagens 
                SET status = 'hospedado' 
                WHERE acomodacao_id = $acomodacao_id 
                AND status = 'reservado' ";

$resultup = mysqli_query($con, $sqlupcheckin);

if ($resultup) {
  if (mysqli_affected_rows($con) > 0) {
    $sqlupacom = "UPDATE acomodacoes 
    SET ocupacao = 1 
    WHERE id = $acomodacao_id";

    $acomres = mysqli_query($con, $sqlupacom);
    header("location:hospedes.php");
    exit;
    
  } else {
    echo "<script>alert('Não é possível realizar checkin, para reservas com status diferentes de Reservado.'); history.back();</script>";
  }
} else {
  echo "<script>alert('Erro ao atualizar status de checkin.'); history.back();</script>";
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