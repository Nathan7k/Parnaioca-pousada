<?php
include '../config/conexao.php';

$hospedagem_id = $_GET['hospedagem_id'];

$sqlacom = "SELECT a.valor, h.data_checkin, h.data_checkout 
            FROM hospedagens h 
            INNER JOIN acomodacoes a ON h.acomodacao_id = a.id 
            WHERE h.id = '$hospedagem_id'";

$resultacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resultacom);

$sql = "SELECT i.nome, c.quantidade, c.valor_unitario, c.total
        FROM consumo_frigobar c
        INNER JOIN itens_frigobar i ON c.item_id = i.id
        WHERE c.hospedagem_id = '$hospedagem_id'";

$res = mysqli_query($con, $sql);

$total_consumo = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $itens[] = $row;
    $total_consumo += $row['total'];
}

$data_checkin = new DateTime($acomodacao['data_checkin']);
$data_checkout = new DateTime($acomodacao['data_checkout']);
$intervalo = $data_checkin->diff($data_checkout);
$dias_hospedados = $intervalo->days == 0 ? 1 : $intervalo->days;

$valor_acomodacao = $acomodacao['valor'] * $dias_hospedados;
$total_geral = $total_consumo + $valor_acomodacao;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nota de Consumo - Hospedagem </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 p-4 bg-white rounded shadow">
    <h2 class="text-center mb-4">Nota de Consumo</h2>

    <div class="mb-3">
        <p><strong>Data Check-in:</strong> <?= date('d/m/Y', strtotime($acomodacao['data_checkin'])) ?></p>
        <p><strong>Data Check-out:</strong> <?= date('d/m/Y', strtotime($acomodacao['data_checkout'])) ?></p>
        <p><strong>Dias de Hospedagem:</strong> <?= $dias_hospedados ?></p>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Valor Unitário (R$)</th>
                <th>Total (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($itens)) : ?>
                <?php foreach ($itens as $item) : ?>
                    <tr class="text-center">
                        <td><?= $item['nome'] ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td><?= number_format($item['valor_unitario'], 2, ',', '.') ?></td>
                        <td><?= number_format($item['total'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="4" class="text-center text-muted">Nenhum item de frigobar registrado.</td></tr>
            <?php endif; ?>
        </tbody>

        <tfoot class="table-secondary text-center fw-bold">
            <tr>
                <td colspan="3">Diária Acomodação (<?= $dias_hospedados ?> dias)</td>
                <td>R$ <?= number_format($valor_acomodacao, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="3">Total Consumo Frigobar</td>
                <td>R$ <?= number_format($total_consumo, 2, ',', '.') ?></td>
            </tr>
            <tr class="table-dark">
                <td colspan="3">Total Geral</td>
                <td>R$ <?= number_format($total_geral, 2, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="d-flex justify-content-between mt-4">
        <a href="javascript:window.print()" class="btn btn-outline-primary">
             Imprimir
        </a>
        <a href="../relatorios/relatorios.php" class="btn btn-secondary">
             Voltar
        </a>
    </div>
</div>

</body>
</html>
