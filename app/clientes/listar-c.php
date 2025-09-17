<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>listar Clientes</h2>

    <form action="listar-c.php" method="">
        <input type="text" name="buscar" placeholder="Buscar por nome ou email">
        <button type="submit">Buscar</button>
    </form>


    <?php
    include '../config/conexao.php';

       
        $buscaTermo = $_GET['buscar'] ?? '';
        if ($buscaTermo != '') {
        $sql = "SELECT * FROM clientes WHERE nome LIKE '%$buscaTermo%' OR email LIKE '%$buscaTermo%'";
        } else {
         $sql = "SELECT * FROM clientes";
        }
        $busca = mysqli_query($con, $sql);
        if (!$busca) {
            echo "Erro na consulta: " . mysqli_error($con);
            exit;
        }

         
?>
    <table border="1">
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
        </tr>

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
            <td><a href="editar-c.php?id=<?php echo $id ?>"><button>Editar</button></a></td>
             <td><a href="excluir-c.php?id=<?php echo $id ?>" onclick = "return confirm('Tem certeza que deseja excluir este funcionário')">Excluir</a></td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>

</html>