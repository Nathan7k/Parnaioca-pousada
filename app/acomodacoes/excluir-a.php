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

    $id_acomodacao = $_GET['id'];
    $sql = "UPDATE acomodacoes set ativo = '0' WHERE id = $id_acomodacao";
    $inativar = mysqli_query($con, $sql);    
    if($inativar){
        echo "<script>alert('Inativado com sucesso!'); location.href='listar-a.php';</script>";
    } else {
        echo "<script>alert('Erro ao Inativar!'); location.href='listar-a.php';</script>";
    }
?>
</body>
</html>