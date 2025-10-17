 <?php
    include '../config/conexao.php';
    include '../funcionarios/navbar-listas.php';


    $sql = "SELECT a.id AS acomodacao_id, a.tipo, a.nome AS acomodacao_nome,
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
     <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
     <link rel="stylesheet" href="../assets/css/navbar-listas.css">
     <link rel="stylesheet" href="../assets/css/table.css">
     <title>Document</title>
 </head>

 <body>

     <main class="container">
         <h2>Controle estacionamento</h2>

         <table id="minhatabela" class="display">

             <thead>

                 <tr>

                     <th>id</th>
                     <th>tipo</th>
                     <th>acomodação</th>
                     <th>número da vaga</th>
                     <th>vaga ocupada</th>


                 </tr>
             </thead>

             <tbody>

                 <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                     <tr>
                         <td><?php echo $row['acomodacao_id'] ?></td>
                         <td><?php echo $row['tipo'] ?></td>
                         <td><?php echo $row['acomodacao_nome'] ?></td>
                         <td><?php echo $row['vaga_numero'] ?? '-' ?></td>
                         <td><?php echo isset($row['ocupada']) ? ($row['ocupada'] ? 'Sim' : 'Não') : 'Não cadastrada' ?></td>
                     </tr>
                 <?php } ?>

             </tbody>





         </table>
         <script>
             $('#minhatabela').DataTable({
                 "language": {
                     "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
                 }
             });
         </script>

     </main>
 </body>

 </html>