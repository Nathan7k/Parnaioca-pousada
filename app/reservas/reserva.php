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

$sqlvagas = "SELECT vaga_numero FROM estacionamento 
             WHERE acomodacao_id = $acomodacao_id AND ocupada = 0";
$resvagas = mysqli_query($con, $sqlvagas);

$sqlstatus = "SELECT status from hospedagens";
$resstatus = mysqli_query($con, $sqlstatus);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $data_checkin = $_POST['data_checkin'];
    $data_checkout = $_POST['data_checkout'];
    $vaga_numero = $_POST['vaga_numero'];
    

    $sqlcheck = "SELECT * FROM hospedagens where acomodacao_id = $acomodacao_id AND status IN ('reservado' , 'hospedado' ) AND NOT (data_checkout <= '$data_checkin' OR data_checkin >= '$data_checkout' )";

     $resCheck = mysqli_query($con, $sqlcheck);

    if (mysqli_num_rows($resCheck) > 0) {
        echo "Acomodação indisponível";
        exit;

    }

     $sqlCheckVaga = "SELECT * FROM estacionamento 
                     WHERE acomodacao_id = $acomodacao_id 
                     AND vaga_numero = $vaga_numero 
                     AND ocupada = 1";

    $resCheckVaga = mysqli_query($con, $sqlCheckVaga);

    if(mysqli_num_rows($resCheckVaga) > 0){
        echo "Essa vaga já está ocupada!";
        exit;
    }

        session_start();
        $funcionario_id = $_SESSION['funcionario_id'] ?? 1;

        
        $sqlinsert = "INSERT INTO hospedagens (cliente_id, acomodacao_id, funcionario_id, data_checkin, data_checkout, status)
                      VALUES ($cliente_id, $acomodacao_id, $funcionario_id, '$data_checkin', '$data_checkout', '')";

        if (mysqli_query($con, $sqlinsert)) {

            $sqlupdatevaga = "UPDATE estacionamento SET ocupada = 1 WHERE acomodacao_id = $acomodacao_id AND vaga_numero = $vaga_numero";

            mysqli_query($con, $sqlupdatevaga);

            echo "Check-in realizado com sucesso!";
        } else {
            echo "Erro ao realizar check-in: " . mysqli_error($con);
        }
    }



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Check-in</title>
</head>
<body>
    <h2>Reserva <?php echo $acomodacao ['nome']?> (<?php echo $acomodacao['numero'];?>)</h2>
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


         <label>Vaga de Estacionamento:</label>
        <select name="vaga_numero" required>
            <option value="">Selecione uma vaga</option>
            <?php while ($vaga = mysqli_fetch_assoc($resvagas)) { ?>
                <option value="<?php echo $vaga['vaga_numero'] ?>">Vaga <?php echo $vaga['vaga_numero'] ?></option>
            <?php } ?>
        </select> </br></br>

      
        <button type="submit">Confirmar Reserva</button>
    </form> 

    <br>
    <a href="acomodacoes.php">Voltar</a>
</body>
</html>
