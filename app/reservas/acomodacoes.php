<?php
include_once("../config/conexao.php");


$sql = "SELECT a.id, a.nome, a.numero, a.valor, a.capacidade_maxima, a.ativo,
               t.nome AS tipo,
               (SELECT COUNT(*) FROM hospedagens h 
                WHERE h.acomodacao_id = a.id 
                AND NOW() BETWEEN h.data_checkin AND h.data_checkout) AS ocupada
        FROM acomodacoes a
        JOIN tipos_acomodacao t ON a.tipo_id = t.id";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Acomodações</title>
</head>
<body>
    <h2>Acomodações</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nome</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Valor (R$)</th>
            <th>Capacidade</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['nome'] ?></td>
                <td><?php echo $row['numero'] ?></td>
                <td><?php echo $row['tipo'] ?></td>
                <td><?php echo $row['valor'] ?></td>
                <td><?php echo $row['capacidade_maxima'] ?></td>
                <td>
                    <?php echo ($row['ocupada'] > 0) ? "<span style='color:red;'>Ocupada</span>" : "<span style='color:green;'>Disponível</span>"; ?>
                </td>
                <td>
                    <?php if($row['ocupada'] == 0) { ?>
                        <a href="checkin.php?acomodacao_id=<?php echo $row['id'] ?>">Check-in</a>
                    <?php } else { ?>
                        <a href="checkout.php?acomodacao_id=<?php echo $row['id'] ?>">Check-out</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
