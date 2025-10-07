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



    $sql = "SELECT * FROM clientes order by ativo desc ";
    $busca = mysqli_query($con, $sql);
    if (!$busca) {
        echo "Erro na consulta: " . mysqli_error($con);
        exit;
    }


    ?>
    <a href="cadastrar-clientes.php"><button class="botao-cadastrar">cadastrar</button></a>
    <main class="container">
        <h2>listar Clientes</h2>

        <table id="minhatabela" class="display">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>data_nascimento</th>
                    <th>cpf</th>
                    <th>Email</th>
                    <th>telefone</th>
                    <th>estado</th>
                    <th>cidade</th>
                    <th>Status</th>
                    <th>reg_date</th>
                    <th>up_date</th>
                    <th>Ações</th>
                </tr>

            </thead>

            <tbody>
                <?php


                while ($array = mysqli_fetch_array($busca)) {
                    $id = $array['id'];
                    $nome = $array['nome'];
                    $data_nascimento = $array['data_nascimento'];
                    $cpf = $array['cpf'];
                    $email = $array['email'];
                    $telefone = $array['telefone'];
                    $estado = $array['estado'];
                    $cidade = $array['cidade'];
                    $ativo = $array['ativo'];
                    $reg_date = $array['created_at'];
                    $up_date = $array['updated_at'];
                ?>

                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $data_nascimento ?></td>
                        <td><?php echo $cpf ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $telefone ?></td>
                        <td><?php echo $estado ?></td>
                        <td><?php echo $cidade ?></td>
                        <td><?php echo $ativo ?></td>
                        <td><?php echo $reg_date ?></td>
                        <td><?php echo $up_date ?></td>
                        <td>
                            <a href="editar-c.php?id=<?php echo $id ?>">
                                <button class="btn-editar">Editar</button>
                            </a>
                            
                            <a href="excluir-c.php?id=<?php echo $id ?>">
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