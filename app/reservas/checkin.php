<?php
include '../config/conexao.php';
include '../config/functions.php';
session_start();


$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
  die("Acomodação não informada!");
}

$sqlacom = "SELECT nome FROM acomodacoes WHERE id = $acomodacao_id";
$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);
$nome = $acomodacao['nome'] ?? 'Desconhecido';

$sqlupcheckin = "UPDATE hospedagens 
                SET status = 'hospedado' 
                WHERE acomodacao_id = $acomodacao_id 
                AND status = 'reservado' ";

$resultup = mysqli_query($con, $sqlupcheckin);

 
    if (mysqli_affected_rows($con) > 0) {

      $sqlupacom = "UPDATE acomodacoes 
      SET ocupacao = 1 
      WHERE id = $acomodacao_id";

      $acomres = mysqli_query($con, $sqlupacom);

    $usuario_id = $_SESSION['usuario_id'] ?? 0;

  registrarLog($con, $usuario_id, "Realizou o check-in da acomodação $nome", "hospedagens", $acomodacao_id);

  
  echo "<script>
    alert('Check-in realizado com sucesso.');
    window.location = document.referrer;
</script>";


} else {
  echo "<script>
    alert('Não é possível realizar check-in para reservas com status diferente de Reservado.');
    window.location = document.referrer;
</script>";

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