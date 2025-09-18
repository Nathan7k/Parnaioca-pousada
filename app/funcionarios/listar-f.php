<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>listar funcionários</h2>

    <form action="listar-f.php" method="get">
        <input type="text" name="buscar" placeholder="Buscar por nome ou email">
        <button type="submit">Buscar</button>
    </form>


    <?php
    
    include '../config/conexao.php';

    $buscaTermo = $_GET['buscar'] ?? '';
    if ($buscaTermo) {
        $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$buscaTermo%' OR email LIKE '%$buscaTermo%'";
    } else {
        $sql = "SELECT * FROM funcionarios";
    }

    $busca = mysqli_query($con, $sql);
    if (!$busca) {
        die("Erro na consulta: " . mysqli_error($con));
    }
    ?>



    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Status</th>
            <th>reg_date</th>
            <th>up_date</th>
        </tr>

        <?php
        

        while ($array = mysqli_fetch_array($busca)) {
            $id = $array['id'];
            $nome = $array['nome'];
            $email = $array['email'];
            $perfil = $array['perfil'];
            $Stat = $array['Stat'];
            $reg_date = $array['created_at'];
            $up_date = $array['updated_at'];
        ?>
        
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $nome ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $perfil ?></td>
            <td><?php echo $Stat ?></td>
            <td><?php echo $reg_date ?></td>
            <td><?php echo $up_date ?></td>
            <td><a href="editar-f.php?id=<?php echo $id ?>"><button>Editar</button></a></td>
            <td><a href="excluir-f.php?id=<?php echo $id ?>"><button>Inativar</button></a></td>
        </tr>
        <?php
        }
        ?>
    </table>


</body>

</html>