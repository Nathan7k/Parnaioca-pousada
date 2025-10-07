
<?php
include '../config/conexao.php';
include '../funcionarios/navbar.php';


$sqlClientes = "SELECT 
                    SUM(CASE WHEN ativo = 1 THEN 1 ELSE 0 END) AS ativos,
                    SUM(CASE WHEN ativo = 0 THEN 1 ELSE 0 END) AS inativos
                FROM clientes";
$resClientes = mysqli_query($con, $sqlClientes);
$clientes = mysqli_fetch_assoc($resClientes);


$sqlAcom = "SELECT 
                SUM(CASE WHEN ocupacao = 1 THEN 1 ELSE 0 END) AS ocupadas,
                SUM(CASE WHEN ocupacao = 0 THEN 1 ELSE 0 END) AS livres
            FROM acomodacoes";
$resAcom = mysqli_query($con, $sqlAcom);
$acom = mysqli_fetch_assoc($resAcom);


$sqlFin = "SELECT 
                SUM(total) AS total_hospedagens 
            FROM hospedagens 
            WHERE status = 'finalizado'";
$resFin = mysqli_query($con, $sqlFin);
$fin = mysqli_fetch_assoc($resFin);


$sqlFrig = "SELECT SUM(total) AS total_frigobar FROM consumo_frigobar";
$resFrig = mysqli_query($con, $sqlFrig);
$frig = mysqli_fetch_assoc($resFrig);

$totalGeral = ($fin['total_hospedagens'] ?? 0) + ($frig['total_frigobar'] ?? 0);


$sqlStatus = "SELECT 
                status, COUNT(*) AS total 
              FROM hospedagens 
              GROUP BY status";
$resStatus = mysqli_query($con, $sqlStatus);
$statusHosp = [];
while ($row = mysqli_fetch_assoc($resStatus)) {
    $statusHosp[$row['status']] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Pousada Paranioca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="main-content">
<div class="dashboard-container shadow rounded p-4">
    <h2 class="text-center mb-4">Dashboard</h2>

    
    <div class="row text-center g-3">
        <div class="col-md-3">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Clientes Ativos</h5>
                    <h3 class="text-success"><?= $clientes['ativos'] ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Clientes Inativos</h5>
                    <h3 class="text-danger"><?= $clientes['inativos'] ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Acomodações Ocupadas</h5>
                    <h3 class="text-primary"><?= $acom['ocupadas'] ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title">Acomodações Livres</h5>
                    <h3 class="text-secondary"><?= $acom['livres'] ?></h3>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row text-center g-3 mt-3">
        <div class="col-md-4">
            <div class="card border-info h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Hospedagens</h5>
                    <h3 class="text-info">R$ <?= number_format($fin['total_hospedagens'] ?? 0, 2, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Frigobar</h5>
                    <h3 class="text-warning">R$ <?= number_format($frig['total_frigobar'] ?? 0, 2, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Geral</h5>
                    <h3 class="text-dark fw-bold">R$ <?= number_format($totalGeral, 2, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mt-4">
        <h4 class="text-center mb-3">Status das Hospedagens</h4>
        <table class="table table-bordered table-striped text-center mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Status</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Reservado</td>
                    <td><?= $statusHosp['reservado'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td>Hospedado</td>
                    <td><?= $statusHosp['hospedado'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td>Finalizado</td>
                    <td><?= $statusHosp['finalizado'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td>Cancelado</td>
                    <td><?= $statusHosp['cancelado'] ?? 0 ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

</body>

</html>

</body>

</html>