<?php
include_once("../config/conexao.php");
include "../funcionarios/navbar-listas.php";

$acomodacao_id = $_GET['acomodacao_id'] ?? null;

if (!$acomodacao_id) {
    die("Acomodação não informada!");
}


$sqlacom = "SELECT nome, numero, valor 
            FROM acomodacoes 
            where id = $acomodacao_id ";
$resacom = mysqli_query($con, $sqlacom);
$acomodacao = mysqli_fetch_assoc($resacom);

$sqlClientes = "SELECT id, nome 
                FROM clientes 
                WHERE ativo = 1 
                ORDER BY nome";
$resClientes = mysqli_query($con, $sqlClientes);

$sqlvagas = "SELECT vaga_numero 
            FROM estacionamento 
             WHERE acomodacao_id = $acomodacao_id 
             AND ocupada = 0";
$resvagas = mysqli_query($con, $sqlvagas);

$sqlstatus = "SELECT status from hospedagens";
$resstatus = mysqli_query($con, $sqlstatus);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $data_checkin = $_POST['data_checkin'];
    $data_checkout = $_POST['data_checkout'];
    $vaga_numero = $_POST['vaga_numero'];

    $timezone = new DateTimeZone('America/Sao_Paulo');
    $checkin = new DateTime($data_checkin, $timezone);
    $checkout = new DateTime($data_checkout, $timezone);
    $hoje = new DateTime( "now", $timezone);

    if (empty($data_checkin) || empty($data_checkout)) {
        echo "<script>alert('As datas de check-in e check-out são obrigatórias.'); history.back();</script>";
        die;
    }

    if ($checkin->format('Y-m-d') < $hoje->format('Y-m-d')) {
        echo "<script>alert('A data de checkin não pode ser no passado.'); history.back();</script>";
        die;
    }

    if ($checkout <= $checkin) {
        echo "<script>alert('A data de checkout deve ser maior que a data de checkin.'); history.back();</script>";
        die;
    }
    $sqlcheck = "SELECT * FROM hospedagens 
                where acomodacao_id = $acomodacao_id 
                AND status IN ('reservado' , 'hospedado' ) 
                AND NOT (data_checkout <= '$data_checkin' OR data_checkin >= '$data_checkout' )";

    $resCheck = mysqli_query($con, $sqlcheck);

    if (mysqli_num_rows($resCheck) > 0) {
        echo "<script>alert('Acomodação indisponível.'); history.back();</script>";
        die;
    }

    foreach ($vaga_numero as $vaga) {
        $sqlCheckVaga = "SELECT * FROM estacionamento 
                     WHERE acomodacao_id = $acomodacao_id 
                     AND vaga_numero = $vaga 
                     AND ocupada = 1";
        $resCheckVaga = mysqli_query($con, $sqlCheckVaga);

        if (mysqli_num_rows($resCheckVaga) > 0) {
            echo "<script>alert('A vaga já está ocupada.'); history.back();</script>";
            die;
        }
    }

    session_start();
    $funcionario_id = $_SESSION['funcionario_id'] ?? 1;


    $sqlinsert = "INSERT INTO hospedagens (cliente_id, acomodacao_id, funcionario_id, data_checkin, data_checkout, status)
                VALUES ($cliente_id, $acomodacao_id, $funcionario_id, '$data_checkin', '$data_checkout', 'reservado')";

    if (mysqli_query($con, $sqlinsert)) {


        foreach ($vaga_numero as $vaga) {
            $sqlupdatevaga = "UPDATE estacionamento 
                          SET ocupada = 1 
                          WHERE acomodacao_id = $acomodacao_id 
                          AND vaga_numero = $vaga";
            mysqli_query($con, $sqlupdatevaga);
        }

        echo "<script>alert('Checkin realizado com sucesso !!.'); history.back();</script>";
    } else {
        echo "<script>alert('Erro ao realizar checkin.'); history.back();</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Check-in</title>
    <link rel="stylesheet" href="../assets/css/navbar-listas.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>


<body>
    <main class="container">
        <h2 class="txth2">Reservar <?php echo $acomodacao['nome'] ?> (<?php echo $acomodacao['numero']; ?>)</h2>
        <p class="parag">Valor da diária: R$ <?php echo $acomodacao['valor']; ?> </p></br></br>


        <form method="POST">
            <div class="select">
                <label>Cliente:</label>
                <select name="cliente_id" required>
                    <option value="">Selecione...</option>
                    <?php while ($cliente = mysqli_fetch_assoc($resClientes)) { ?>
                        <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['nome'] ?></option>
                    <?php } ?>

                </select>
                <br><br>
            </div>

            <div class="select">
                <label>Data Check-in:</label>
                <input type="datetime-local" name="data_checkin" required>
                <br><br>

                <label>Data Check-out:</label>
                <input type="datetime-local" name="data_checkout" required>
                <br><br>
            </div>


            <div class="vagas">
                <label>Vagas de Estacionamento:</label>
                <div class="vagas-lista">
                    <?php while ($vaga = mysqli_fetch_assoc($resvagas)) { ?>
                        <label class="vaga">
                            <input type="checkbox" name="vaga_numero[]" value="<?php echo $vaga['vaga_numero']; ?>">
                            Vaga <?php echo $vaga['vaga_numero']; ?>
                        </label>
                    <?php } ?>
                </div>
            </div>

            <button class="bt_confirm" type="submit">Confirmar Reserva</button>

            <button type="button" class="btn_return" onclick="location.href = 'hospedes.php'">Ir para página de hospedes</button>
        </form>
    </main>

</body>

</html>