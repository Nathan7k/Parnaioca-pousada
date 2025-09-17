<?php
include_once("../config/conexao.php");

$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if(!$acomodacao_id){
    die("Acomodação não informada!");
}


$sqlacom = "SELECT nome, numero, valor FROM acomodacoes where id = $acomodacao_id ";
$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);

$sqlClientes = "SELECT id, nome FROM clientes WHERE ativo = 1 ORDER BY nome";
$resClientes = mysqli_query($con, $sqlClientes);




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Check-in</title>
</head>
<body>
    <h2>Check-in <?php echo $acomodacao ['nome']?> (<?php echo $acomodacao['numero'];?>)</h2>
    <p>Valor da diária: R$ <?php echo $acomodacao ['valor']; ?> </p>

    <form method="POST">
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <option value="">Selecione...</option>
            <?php while($cliente = mysqli_fetch_assoc($resClientes)) { ?>
                <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['nome'] ?></option>
            <?php } ?>
            
        </select>
        <br><br>

        <label>Data Check-in:</label>
        <input type="date" name="data_checkin" required>
        <br><br>

        <label>Data Check-out:</label>
        <input type="date" name="data_checkout" required>
        <br><br>

        <button type="submit">Confirmar Check-in</button>
    </form>

    <br>
    <a href="acomodacoes.php">← Voltar</a>
</body>
</html>
