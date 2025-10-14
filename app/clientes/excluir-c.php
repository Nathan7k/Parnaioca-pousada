<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include '../config/conexao.php';
    include '../config/functions.php';

    $id_cliente = $_GET['id'];

    if (!$id_cliente) {
        echo "<script>alert('ID do Cliente não informado!'); location.href='listar-c.php'</script>";
    }



    $sql = "UPDATE clientes 
            set ativo = '0' 
            WHERE id = $id_cliente";


    $inativar = mysqli_query($con, $sql);
    if ($inativar) {

        $usuario_id = $_SESSION['usuario_id'] ?? 0;

        $sqlCliente = "SELECT nome FROM clientes WHERE id = $id_cliente";

        $resCliente = mysqli_query($con, $sqlCliente );
        $cliente = mysqli_fetch_assoc($resCliente);
        $nome_cliente = $cliente['nome'] ?? '';

        registrarLog($con, $usuario_id, "Inativou o cliente $nome_cliente", "clientes", $id_cliente);

        echo "<script>alert('Inativado com sucesso!'); location.href='listar-c.php';</script>";
    } else {

        echo "<script>alert('Erro ao Inativar!'); location.href='listar-c.php';</script>";
    }
    ?>
</body>

</html>