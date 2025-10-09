<?php
include '../config/conexao.php';

$sql = "SELECT l.*, f.nome AS funcionario
        FROM logs l
        JOIN funcionarios f ON f.id = l.usuario_id
        ORDER BY l.created_at DESC";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logs do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4"> Logs do Sistema</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Funcionário</th>
                    <th>Ação</th>
                    <th>Tabela</th>
                    <th>ID Registro</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($log = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $log['id'] ?></td>
                        <td><?= $log['funcionario'] ?></td>
                        <td><?= $log['acao'] ?></td>
                        <td><?= $log['tabela_afetada'] ?></td>
                        <td><?= $log['registro_id'] ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

</body>
</html>
