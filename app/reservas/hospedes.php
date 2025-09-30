<?php
include_once("../config/conexao.php");
include '../funcionarios/navbar-listas.php';


$sql = "SELECT * from hospedagens ORDER BY status ASC ";
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
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/navbar-listas.css">
    

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
                        <td><?php echo $row['cliente_id'] ?></td>
                        <td><?php echo $row['acomodacao_id'] ?></td>
                        <td><?php echo $row['funcionario_id'] ?></td>
                        <td><?php echo $row['data_checkin'] ?></td>
                        <td><?php echo $row['data_checkout'] ?></td>
                        
                          <td><?php echo $row['status'] ?></td>
                       
                        <td>
                            
                                <button><a href="checkin.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>"style= "text-decoration: none; color:aliceblue;">checkin</a></button>
                            <button>
                                <a href="checkout.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>"
                                style= "text-decoration: none; color:aliceblue;">Check-out</a></button>

                                <button style="background-color: #fa4121ff;">
                                <a href="cancelar.php?acomodacao_id=<?php echo $row['acomodacao_id'] ?>"
                                style= "text-decoration: none;
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
            }
        });
    </script>


    
</body>

</html>