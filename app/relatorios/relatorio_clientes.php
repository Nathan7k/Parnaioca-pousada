<?php
include '../config/conexao.php';


$sql = "SELECT id, nome, email, telefone, ativo FROM clientes ORDER BY ativo DESC, nome ASC";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}


$sqlCount = "SELECT 
                SUM(CASE WHEN ativo = 1 THEN 1 ELSE 0 END) AS ativos,
                SUM(CASE WHEN ativo = 0 THEN 1 ELSE 0 END) AS inativos,
                COUNT(*) AS total
            FROM clientes";
$resCount = mysqli_query($con, $sqlCount);
$contagem = mysqli_fetch_assoc($resCount);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4"> Relatório de Clientes</h2>

    
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="text-success fw-bold mb-0"><?= $contagem['ativos'] ?></h5>
                    <small class="text-muted">Clientes Ativos</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="text-danger fw-bold mb-0"><?= $contagem['inativos'] ?></h5>
                    <small class="text-muted">Clientes Inativos</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="text-primary fw-bold mb-0"><?= $contagem['total'] ?></h5>
                    <small class="text-muted">Total de Clientes</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($cliente = mysqli_fetch_assoc($result)) {
                        $statusTexto = $cliente['ativo'] ? 'Ativo' : 'Inativo';
                        $statusClasse = $cliente['ativo'] ? 'text-success fw-bold' : 'text-danger fw-bold';

                        echo '<tr>';
                        echo '<td>' . $cliente['id'] . '</td>';
                        echo '<td>' . $cliente['nome'] . '</td>';
                        echo '<td>' . $cliente['email'] . '</td>';
                        echo '<td>' . $cliente['telefone'] . '</td>';
                        echo '<td class="text-center ' . $statusClasse . '">' . $statusTexto . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>Nenhum cliente encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="../relatorios/relatorios.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

</body>
</html>
