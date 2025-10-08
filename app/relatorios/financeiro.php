<?php
include_once("../config/conexao.php");


$data_inicial = $_GET['inicio'] ?? '';
$data_final = $_GET['fim'] ?? '';

$filtro = "";
if (!empty($data_inicial) && !empty($data_final)) {
    $filtro = "AND h.data_checkin BETWEEN '$data_inicial' AND '$data_final'";
}


$sql = "SELECT 
    a.nome AS nome_acomodacao,
    h.id,
    h.data_checkin,
    h.total AS total_hospedagem,
    IFNULL(cf.total_frigobar, 0) AS total_frigobar,
    h.total + IFNULL(cf.total_frigobar, 0) AS total_geral
    FROM hospedagens h
    inner join acomodacoes a 
    on (h.acomodacao_id = a.id)
    LEFT JOIN (
    SELECT hospedagem_id, SUM(total) AS total_frigobar
    FROM consumo_frigobar
    GROUP BY hospedagem_id
) cf ON h.id = cf.hospedagem_id
WHERE h.status = 'finalizado' $filtro
ORDER BY h.data_checkin ASC";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h2 class="text-center mb-4"> Relatório Financeiro</h2>


        <form method="get" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="inicio" class="form-label">Data Inicial</label>
                <input type="date" name="inicio" id="inicio" class="form-control" value="<?= $data_inicial ?>">
            </div>
            <div class="col-md-4">
                <label for="fim" class="form-label">Data Final</label>
                <input type="date" name="fim" id="fim" class="form-control" value="<?= $data_final ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>


        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Data Check-in</th>
                    <th>Acomodação</th>
                    <th>Valor Hospedagem (R$)</th>
                    <th>Consumo Frigobar (R$)</th>
                    <th>Total Geral (R$)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_hospedagem = 0;
                $total_frigobar = 0;
                $total_geral = 0;

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_hospedagem += $row['total_hospedagem'];
                        $total_frigobar += $row['total_frigobar'];
                        $total_geral += $row['total_geral'];
                ?>
                        <tr class="text-center">
                            <td><?= date('d/m/Y', strtotime($row['data_checkin'])) ?></td>
                            <td><?= $row['nome_acomodacao'] ?></td>
                            <td><?= number_format($row['total_hospedagem'], 2, ',', '.') ?></td>
                            <td><?= number_format($row['total_frigobar'], 2, ',', '.') ?></td>
                            <td><strong><?= number_format($row['total_geral'], 2, ',', '.') ?></strong></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>Nenhum registro encontrado para o período selecionado.</td></tr>";
                }
                ?>
            </tbody>

            <?php if ($total_geral > 0): ?>
                <tfoot class="table-secondary">
                    <tr class="text-center fw-bold">
                        <td colspan="2">Totais</td>
                        <td><?= number_format($total_hospedagem, 2, ',', '.') ?></td>
                        <td><?= number_format($total_frigobar, 2, ',', '.') ?></td>
                        <td><?= number_format($total_geral, 2, ',', '.') ?></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>

        <div class="d-flex justify-content-end mt-3">
            <a href="../relatorios/relatorios.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</body>

</html>