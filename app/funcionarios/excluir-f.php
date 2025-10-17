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
    include '../../login/verificar_permissao.php';
    verificarPerfil(['admin']);

    

    if (isset($_GET['id'])) {

        $id_funcionario = $_GET['id'];

        $sqlbusca = "SELECT nome
                    FROM funcionarios
                    WHERE id = $id_funcionario";

        $resultbusca = mysqli_query($con, $sqlbusca);
        
        $dados = mysqli_fetch_assoc($resultbusca);

        $nome_funcionario = $dados['nome'] ?? 'Desconhecido';

        $sql = "UPDATE funcionarios
             set ativo = '0' 
             WHERE id = $id_funcionario";
        $deletar = mysqli_query($con, $sql);


        if ($deletar) {

            $usuario_id = $_SESSION['usuario_id'];

            registrarLog($con, $usuario_id, "Inativou o funcionário $nome_funcionario", "funcionarios", $id_funcionario);

            echo "<script>alert('Funcionário inativado com sucesso!'); location.href='listar-f.php';</script>";
        } else {
            echo "<script>alert('Erro ao inativar funcionário!'); location.href='listar-f.php';</script>";
        }
    } else {
        echo "<script>alert('ID de funcionário não informado!'); location.href='listar-f.php';</script>";
    }
    ?>
</body>

</html>