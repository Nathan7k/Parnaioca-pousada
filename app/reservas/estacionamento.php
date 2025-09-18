 <?php
    include '../config/conexao.php';


$sql = "SELECT a.id AS acomodacao_id, a.tipo_id, a.nome AS acomodacao_nome,
               e.vaga_numero, e.ocupada
        FROM acomodacoes a
        LEFT JOIN estacionamento e ON a.id = e.acomodacao_id
        ORDER BY a.id, e.vaga_numero";

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
     <h2>Controle estacionamento</h2>

     <table border="1">

         <tr>
             <th>id</th>
             <th>tipo_id</th>
             <th>acomodação_id</th>
             <th>número_da_vaga</th>
             <th>vaga</th>


         </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['acomodacao_id'] ?></td>
                <td><?php echo $row['tipo_id'] ?></td>
                <td><?php echo $row['acomodacao_nome'] ?></td>
                <td><?php echo $row['vaga_numero'] ?? '-' ?></td>
                <td><?php echo isset($row['ocupada']) ? ($row['ocupada'] ? 'Sim' : 'Não') : 'Não cadastrada' ?></td>
            </tr>
        <?php } ?>







     </table>
 </body>

 </html>