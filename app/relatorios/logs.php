<?php
include '../config/conexao.php';
include './navBar.php';


$sql = "SELECT l.*, f.nome AS funcionario
        FROM logs l
        JOIN funcionarios f ON f.id = l.usuario_id
        ORDER BY l.created_at DESC ";
        
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Logs do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link href="../assets/css/root.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <h2 class="text-center mb-4"> Logs do Sistema</h2>

         <div class="card mb-4 p-3 shadow-sm">
        <div class="row g-3 align-items-end">

        

        <div class="table-responsive">
            <table id="tabela-logs" class="table table-striped table-bordered">
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
                            <td><?php echo $log['id'] ?></td>
                            <td><?php echo $log['funcionario'] ?></td>
                            <td><?php echo $log['acao'] ?></td>
                            <td><?php echo $log['tabela_afetada'] ?></td>
                            <td><?php echo $log['registro_id'] ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($log['created_at'])) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="../funcionarios/home.php" class="btn btn-secondary">Voltar</a>
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
            $('#tabela-logs').DataTable({
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
                order: [
                    [0, 'desc']
                ],
                pageLength: 10
            });
        });
    </script>

</body>

</html>