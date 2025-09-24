<?php
include '../config/conexao.php';

$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if(!$acomodacao_id){
    die("Acomodação não informada!");
}

$sqlacom = "SELECT nome, numero, valor FROM acomodacoes WHERE id = $acomodacao_id";
$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);


echo $sqlhosp = "SELECT h.id, h.cliente_id, h.data_checkin, h.data_checkout, c.nome, e.vaga_numero FROM hospedagens h INNER JOIN clientes c ON (c.id = h.cliente_id) INNER JOIN estacionamento e ON (e.acomodacao_id = h.acomodacao_id)  WHERE h.acomodacao_id = $acomodacao_id AND h.status = 'hospedado' AND e.ocupada = 1" ;

$reshosp = mysqli_query($con, $sqlhosp);
$hospedagem = mysqli_fetch_assoc($reshosp);

if (!$hospedagem) {
    die("Nenhuma hospedagem ativa encontrada para essa acomodação!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_real_checkout = date('Y-m-d'); 

    
    echo $sqlupdatehosp = "UPDATE hospedagens SET status = 'finalizado' WHERE id ={$hospedagem['id']}";

    if(mysqli_query($con, $sqlupdatehosp)){

        
        $sqlLiberaVaga = "UPDATE estacionamento SET ocupada = 0 WHERE acomodacao_id = $acomodacao_id AND ocupada = 1";

        mysqli_query($con, $sqlLiberaVaga);

        echo "<script>alert('Check-out realizado com sucesso!');location.href='acomodacoes.php';</script>";
    } else {
        echo "Erro ao realizar check-out: " . mysqli_error($con);
    }
}
?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Check-out</title>
</head>
<body>
    <h2>Check-out <?php echo $acomodacao['nome']?> (<?php echo $acomodacao['numero'];?>)</h2>
    <p>Cliente: <?php echo $hospedagem['nome']; ?></p>
    <p>Data Check-in: <?php echo $hospedagem['data_checkin']; ?></p>
    <p>Data Prevista Check-out: <?php echo $hospedagem['data_checkout']; ?></p>
    <p>Vaga utilizada: <?php echo $hospedagem['vaga_numero'] ?: "Nenhuma"; ?></p>

    <form method="POST">
        <button type="submit">Confirmar Check-out</button>
    </form>

    <br>
    <a href="acomodacoes.php">Voltar</a>
</body>
</html>
