<?php
include '../config/conexao.php';


$hospedagem_id = $_GET['hospedagem_id'];

$sqlacom = "SELECT a.valor, h.data_checkin, h.data_checkout FROM hospedagens h INNER JOIN acomodacoes a ON h.acomodacao_id = a.id WHERE h.id = '$hospedagem_id'";

$resultacom= mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resultacom);


$sql = "SELECT i.nome, c.quantidade, c.valor_unitario, c.total
        FROM consumo_frigobar c
        INNER JOIN itens_frigobar i ON c.item_id = i.id
        WHERE c.hospedagem_id = '$hospedagem_id'";

$res = mysqli_query($con, $sql);

echo "<h2>Nota de Consumo - Hospedagem #$hospedagem_id</h2>";
echo "<table border='1' cellpadding='5'>
        <tr>
            <th>Item</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Total</th>
        </tr>";

$total_consumo = 0;
while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <td>{$row['nome']}</td>
            <td>{$row['quantidade']}</td>
            <td>R$ {$row['valor_unitario']}</td>
            <td>R$ {$row['total']}</td>
          </tr>";

    $total_consumo += $row['total'];
}

$data_checkin = new DateTime($acomodacao['data_checkin']);
$data_checkout = new DateTime($acomodacao['data_checkout']);
$intervalo = $data_checkin->diff($data_checkout);
$dias_hospedados = $intervalo->days;

if ($dias_hospedados == 0){
        $dias_hospedados = 1;
}



$valor_acomodacao = $acomodacao['valor'] * $dias_hospedados;
$total_geral = $total_consumo + $valor_acomodacao;


echo "<tr>
        <td colspan='3'><strong>Diária Acomodação ({$dias_hospedados} dias)</strong></td>
        <td><strong>R$ " . number_format($valor_acomodacao, 2, ',', '.') . "</strong></td>
      </tr>";

echo "<tr>
        <td colspan='3'><strong>Total Geral</strong></td>
        <td><strong>R$ " . number_format($total_geral, 2, ',', '.') . "</strong></td>
      </tr>";
echo "</table>";
?>