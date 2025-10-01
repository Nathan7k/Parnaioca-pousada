<?php
include_once("../config/conexao.php");
include '../funcionarios/navbar-listas.php';


$sql = "SELECT * from acomodacoes";
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

        <h2>Acomodações</h2>
        <table id="minhatabela" class="display">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Número</th>
                    <th>Valor (R$)</th>
                    <th>Capacidade</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>

            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['numero'] ?></td>
                        <td><?php echo $row['valor'] ?></td>
                        <td><?php echo $row['capacidade_maxima'] ?></td>
                        <td>
                            <?php echo ($row['ocupacao'] > 0) ? "<span style='color:red;'>ocupada</span>" : "<span style='color:green;'>Disponível</span>"; ?>
                        </td>
                        <td> 
                                <button style="background-color: #24c052ff;">
                                    <a href="reserva.php?acomodacao_id=<?php echo $row['id'] ?>"style= "text-decoration: none; color:aliceblue;">reservar</a></button>
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