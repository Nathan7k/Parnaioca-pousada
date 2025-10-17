<?php
include_once("../config/conexao.php");
include '../funcionarios/navbar-listas.php';


$sql = "SELECT  
     h.id AS hospedagem_id,
        c.id AS cliente_id,
        c.nome AS nome_cliente,
        a.id AS acomodacao_id,
        a.nome AS nome_acomodacao,
        f.id AS funcionario_id,
        f.nome AS nome_funcionario,
        h.data_checkin,
        h.data_checkout,
        h.status
      
    FROM
        hospedagens AS h
    JOIN
        clientes AS c ON h.cliente_id = c.id
    JOIN
        acomodacoes AS a ON h.acomodacao_id = a.id
    JOIN
        funcionarios AS f ON h.funcionario_id = f.id
    ORDER BY h.data_checkin DESC";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Acomodações</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../assets/css/navbar-listas.css">
    <link rel="stylesheet" href="../assets/css/table.css">


</head>

<body>


    <main class="container">

        <h2>Hospedes</h2>
        <table id="minhatabela" class="display">
            <thead>
                <tr>
                    <th>Cliente id</th>
                    <th>Acomodacao id</th>
                    <th>Funcionario id</th>
                    <th>Data Checkin</th>
                    <th>Data checkout</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>

            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nome_cliente'] ?></td>
                        <td><?php echo $row['nome_acomodacao'] ?></td>
                        <td><?php echo $row['nome_funcionario'] ?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($row['data_checkin'])) ?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($row['data_checkout'])) ?></td>

                        <td><?php echo $row['status'] ?></td>


                        <td>

                            <button style="background-color: #4fa3f7ff;"><a href="checkin.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>" style="text-decoration: none; color:aliceblue;">checkin</a></button>
                            <button>
                                <a href="checkout.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>"
                                    style="text-decoration: none; color:aliceblue;">Check-out</a></button>

                            <button style="background-color: #fa4121ff;">
                                <a href="cancelar.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>"
                                    style="text-decoration: none;
                                color:aliceblue;
                                
                                ">Cancelar</a></button>

                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </main>

    <script>
        $('#minhatabela').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            },
            order: [[2, 'asc']]
        });
        
    </script>



</body>

</html>