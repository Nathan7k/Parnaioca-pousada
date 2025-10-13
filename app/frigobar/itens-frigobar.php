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
    <title>Document</title>
</head>

<body>
    
    <?php

    include '../config/conexao.php';
    include '../funcionarios/navbar-listas.php';


    $sql = "SELECT * FROM itens_frigobar order by ativo desc ";


    $busca = mysqli_query($con, $sql);
    if (!$busca) {
        die("Erro na consulta: " . mysqli_error($con));
    }
    ?>

<button class="botao-cadastrar" onclick="location.href='cadastrar-frigobar.php'">
  cadastrar
</button>

<main class="container">
    
    <h2>lista de itens do frigobar</h2>

    

    <table id="minhatabela" class="display">
        

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>

    <tbody>
        <?php


        while ($array = mysqli_fetch_array($busca)) {
            $id = $array['id'];
            $nome = $array['nome'];
            $valor = $array['valor'];
            $ativo = $array['ativo'];
            
        ?>


            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $nome ?></td>
                <td><?php echo $valor ?></td>
                <td><?php echo ($ativo == 1) ? 'ativo' : 'inativo' ?></td>
                

                 <td>
                            <a href="editar-frigobar.php?id=<?php echo $id ?>">
                                <button class="btn-editar">Editar</button>
                            </a>
                            
                            <a href="excluir-frigobar.php?id=<?php echo $id ?>">
                                <button class="btn-inativar">Inativar</button>
                            </a>
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