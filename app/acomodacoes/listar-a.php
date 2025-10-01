<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../assets/css/navbar-listas.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    
</head>
<body>
    
    <?php
    include '../config/conexao.php';
    include '../funcionarios/navbar-listas.php';


    $sql = "SELECT * FROM acomodacoes";


    $busca = mysqli_query($con, $sql);
    if (!$busca) {
        die("Erro na consulta: " . mysqli_error($con));
    }
    ?>

<a href="cadastrar-a.php"><button class="botao-cadastrar">cadastrar</button></a>
<main class="container">
    <h2>lista de acomodações</h2>
    <table id="minhatabela" class="display">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>numero</th>
                <th>Valor</th>
                <th>Capacidade máxima</th>
                <th>Ocupação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

    <tbody>
        <?php


        while ($array = mysqli_fetch_array($busca)) {
            $id = $array['id'];
            $tipo_id = $array['tipo_id'];
            $nome  = $array['nome'];
            $numero = $array['numero'];
            $valor = $array['valor'];
            $capacidade_maxima = $array['capacidade_maxima'];
            $ocupacao = $array['ocupacao'];
            $ativo = $array['ativo'];
        ?>


            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $tipo_id ?></td>
                <td><?php echo $nome ?></td>
                <td><?php echo $numero ?></td>
                <td><?php echo $valor ?></td>
                <td><?php echo $capacidade_maxima?></td>
                <td><?php echo $ocupacao ?></td>
                <td><?php echo $ativo ?></td>

                <td>
                    <a href="editar-a.php?id=<?php echo $id ?>"><button style="background-color: #24c052ff;" >Editar</button></a>
                    <a href="excluir-a.php?id=<?php echo $id ?>"><button style="background-color: #fa4121ff;">Inativar</button></a>
                    
                </td>
            </tr>
        <?php
        }
        ?>
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