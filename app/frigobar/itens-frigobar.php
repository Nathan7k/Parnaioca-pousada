<?php
    include '../config/conexao.php';


    $sql= "SELECT * FROM itens_frigobar";

    $result = mysqli_query($con, $sql);
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tabela de valores frigobar</h2>

    <table border = "1" cellpading = "8">

        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Valor</th>
        </tr>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['nome']?></td>
            <td><?php echo $row['valor']?></td>
            
        </tr>

    <?php } ?>
    
    </table>
</body>
</html>