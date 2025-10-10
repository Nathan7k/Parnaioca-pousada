<?php
include '../config/conexao.php';
session_start();


$data_inicio = $_GET['data_inicio'] ?? null;
$data_fim = $_GET['data_fim'] ?? null;


$data_inicio_esc = mysqli_real_escape_string($con, $data_inicio);
$data_fim_esc = mysqli_real_escape_string($con, $data_fim);


$sqlCount = "SELECT 
                SUM(CASE WHEN ativo = 1 THEN 1 ELSE 0 END) AS ativos,
                SUM(CASE WHEN ativo = 0 THEN 1 ELSE 0 END) AS inativos,
                COUNT(*) AS total
            FROM clientes
            WHERE 1=1";

if (!empty($data_inicio_esc) && !empty($data_fim_esc)) {
    $sqlCount .= " AND created_at 
                    BETWEEN '$data_inicio_esc 00:00:00' 
                    AND '$data_fim_esc 23:59:59'";
}

$resCount = mysqli_query($con, $sqlCount);
if (!$resCount) {
    die("Erro na consulta SQL de contagem: " . mysqli_error($con));
}
$contagem = mysqli_fetch_assoc($resCount);


$sql = "SELECT id, nome, email, telefone, ativo, created_at 
        FROM clientes 
        WHERE 1=1";

if (!empty($data_inicio_esc) && !empty($data_fim_esc)) {
    $sql .= " AND created_at 
    BETWEEN '$data_inicio_esc 00:00:00' 
    AND '$data_fim_esc 23:59:59'";
}

$sql .= " ORDER BY ativo DESC, nome ASC";
$result = mysqli_query($con, $sql);
if (!$result) {
    die("Erro na consulta SQL de clientes: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4">Relatório de Clientes</h2>

    
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

    
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Data Inicial</label>
            <input type="date" name="data_inicio" class="form-control" value="<?= htmlspecialchars($data_inicio) ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Data Final</label>
            <input type="date" name="data_fim" class="form-control" value="<?= htmlspecialchars($data_fim) ?>">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    
    <div class="table-responsive">
        <table id="tabela-clientes" class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Data Cadastro</th>
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
                        echo '<td>' . htmlspecialchars($cliente['nome']) . '</td>';
                        echo '<td>' . htmlspecialchars($cliente['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($cliente['telefone']) . '</td>';
                        echo '<td class="text-center ' . $statusClasse . '">' . $statusTexto . '</td>';
                        echo '<td>' . $cliente['created_at'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-muted'>Nenhum cliente encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="../relatorios/relatorios.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabela-clientes').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        },
        order: [[0, 'asc']],
        pageLength: 10
    });
});
</script>

</body>
</html>
