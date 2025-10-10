<?php
include '../config/conexao.php';

$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
    die("Acomodação não informada!");
}

$sqlfrigobar = "SELECT * FROM itens_frigobar";
$resultfrigobar = mysqli_query($con, $sqlfrigobar);

$sqlacom = "SELECT nome, numero, valor 
            FROM acomodacoes 
            WHERE id = $acomodacao_id";
$resacom = mysqli_query($con, $sqlacom);

$acomodacao = mysqli_fetch_assoc($resacom);

$sqlhosp = "SELECT h.id, h.cliente_id, h.data_checkin, h.data_checkout, c.nome, e.vaga_numero 
            FROM hospedagens h 
            INNER JOIN clientes c ON (c.id = h.cliente_id) 
            INNER JOIN estacionamento e ON (e.acomodacao_id = h.acomodacao_id)  
            WHERE h.acomodacao_id = $acomodacao_id 
              AND h.status = 'hospedado' 
              AND e.ocupada = 1";

$reshosp = mysqli_query($con, $sqlhosp);
$hospedagem = mysqli_fetch_assoc($reshosp);

if (!$hospedagem) {
    die("Nenhuma hospedagem ativa encontrada para essa acomodação!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospedagem_id = $_POST['hospedagem_id'];
    $itens = $_POST['itens'] ?? [];

    $sql_itens = "SELECT id, valor 
                FROM itens_frigobar";

    $res_itens = mysqli_query($con, $sql_itens);
    $precos = [];
    while ($row = mysqli_fetch_assoc($res_itens)) {
        $precos[$row['id']] = $row['valor'];
    }

    $total_frigobar = 0;
    foreach ($itens as $item_id => $quantidade) {
        if ($quantidade > 0) {
            $valor_unitario = $precos[$item_id];
            $total = $valor_unitario * $quantidade;
            $total_frigobar += $total;

            $sql_insert = "INSERT INTO consumo_frigobar 
                           (hospedagem_id, item_id, quantidade, valor_unitario, total) 
                           VALUES ('$hospedagem_id', '$item_id', '$quantidade', '$valor_unitario', '$total')";
            mysqli_query($con, $sql_insert) or die("Erro ao inserir consumo: " . mysqli_error($con));
        }
    }

    $checkin = new DateTime($hospedagem['data_checkin']);
    $checkout = new DateTime($hospedagem['data_checkout']);
    $dias = $checkin->diff($checkout)->days;
    if ($dias == 0) $dias = 1;

    $valor_diaria = $acomodacao['valor'];
    $total_hospedagem = $valor_diaria * $dias;


    $total_final = $total_hospedagem + $total_frigobar;


    $sqlAtualizaTotal = "UPDATE hospedagens 
                         SET total = '$total_hospedagem' 
                         WHERE id = {$hospedagem['id']}";
    mysqli_query($con, $sqlAtualizaTotal);

    $sqlupdatehosp = "UPDATE hospedagens 
                    SET status = 'finalizado' 
                    WHERE id = {$hospedagem['id']}";

    if (mysqli_query($con, $sqlupdatehosp)) {


        $sqlLiberaVaga = "UPDATE estacionamento 
                        SET ocupada = 0 
                        WHERE acomodacao_id = $acomodacao_id 
                        AND ocupada = 1";

        mysqli_query($con, $sqlLiberaVaga);


        $sqlupacom = "UPDATE acomodacoes 
                    SET ocupacao = 0 
                    WHERE id = $acomodacao_id";

        mysqli_query($con, $sqlupacom);


        echo "<script>location.href='emitir_nota.php?hospedagem_id={$hospedagem['id']}';</script>";
        exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h2 class="mb-3 text-center"> Check-out - <?php echo $acomodacao['nome']; ?> (<?php echo $acomodacao['numero']; ?>)</h2>

        <p><strong>Cliente:</strong> <?php echo $hospedagem['nome']; ?></p>
        <p><strong>Data Check-in:</strong> <?php echo date('d/m/Y H:i', strtotime($hospedagem['data_checkin'])); ?></p>
        <p><strong>Data Prevista Check-out:</strong> <?php echo date('d/m/Y H:i', strtotime($hospedagem['data_checkout'])); ?></p>
        <p><strong>Vaga utilizada:</strong> <?php echo $hospedagem['vaga_numero'] ?: "Nenhuma"; ?></p>
        <p><strong>Valor diária:</strong> R$ <?php echo number_format($acomodacao['valor'], 2, ',', '.'); ?></p>

        <hr>

        <form method="POST">
            <input type="hidden" name="hospedagem_id" value="<?php echo $hospedagem['id']; ?>">

            <h4>Consumo do Frigobar</h4>
            <div class="row">
                <?php while ($item = mysqli_fetch_assoc($resultfrigobar)) { ?>
                    <div class="col-md-4 mb-3">
                        <label class="form-label"><?php echo $item['nome']; ?> (R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?>)</label>
                        <input type="number" name="itens[<?php echo $item['id']; ?>]" class="form-control" min="0" value="0">
                    </div>
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Emitir Nota e Finalizar</button>
        </form>

        <div class="mt-3 text-center">
            <a href="acomodacoes.php" class="btn btn-secondary"> Voltar</a>
        </div>
    </div>
</body>

</html>