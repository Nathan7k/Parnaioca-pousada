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
    include '../../login/verificar_permissao.php';

    verificarPerfil(['admin']);


    $sql = "SELECT * FROM funcionarios order by ativo desc ";


    $busca = mysqli_query($con, $sql);
    if (!$busca) {
        die("Erro na consulta: " . mysqli_error($con));
    }
    ?>

    <a href="cadastrar-f.php"><button class="botao-cadastrar">cadastrar</button></a>

    <main class="container">

        <h2>lista de funcionários</h2>



        <table id="minhatabela" class="display">


            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th>data de registro</th>
                    <th>última alteração</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php


                while ($array = mysqli_fetch_array($busca)) {
                    $id = $array['id'];
                    $nome = $array['nome'];
                    $email = $array['email'];
                    $perfil = $array['perfil'];
                    $ativo = $array['ativo'];
                    $reg_date = $array['created_at'];
                    $up_date = $array['updated_at'];
                    $reg_date = !empty($array['created_at']) ? date("d/m/Y H:i", strtotime($array['created_at'])):'-';

                    $up_date  = !empty($array['updated_at']) ? date("d/m/Y H:i", strtotime($array['updated_at'])) : '-';
                ?>


                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $perfil ?></td>
                        <td><?php echo ($ativo == 1) ? 'ativo':'inativo'; ?></td>
                        <td><?php echo $reg_date ?></td>
                        <td><?php echo $up_date ?></td>

                         <td>
                            <a href="editar-f.php?id=<?php echo $id ?>">
                                <button class="btn-editar">Editar</button>
                            </a>
                            
                            <a href="excluir-f.php?id=<?php echo $id ?>">
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