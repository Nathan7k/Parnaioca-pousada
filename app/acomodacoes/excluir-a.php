<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include '../config/conexao.php';
    include '../config/functions.php';
    session_start();


    $id_acomodacao = $_GET['id'];


    $sqlAcom = "SELECT nome FROM acomodacoes WHERE id = $id_acomodacao";
    $result = mysqli_query($con, $sqlAcom);
    $acomodacao = mysqli_fetch_assoc($result);
    $nome = $acomodacao['nome'] ?? 'Desconhecido';

    $sql = "UPDATE acomodacoes set ativo = '0' WHERE id = $id_acomodacao";
    $inativar = mysqli_query($con, $sql);
    if ($inativar) {

        $usuario_id = $_SESSION['usuario_id'] ?? 0;

        registrarLog($con, $usuario_id, "Inativou a acomodação $nome", "acomodacoes", $id_acomodacao);

        echo "<script>alert('Inativado com sucesso.'); location.href='listar-a.php';</script>";
    } else {

        echo "<script>alert('Erro ao Inativar acomodação.'); location.href='listar-a.php';</script>";
    }


    ?>
</body>

</html>