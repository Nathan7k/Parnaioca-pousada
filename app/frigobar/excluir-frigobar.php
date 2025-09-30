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

    $iditens = $_GET['id'];
    $sql = "UPDATE itens_frigobar set ativo = '0' WHERE id = $iditens";
    $update = mysqli_query($con, $sql);    
    if($update){
        echo "<script>alert('Inativado com sucesso!'); location.href='itens-frigobar.php';</script>";
    } else {
        echo "<script>alert('Erro ao Inativar!'); location.href='itens-frigobar.php';</script>";
    }
?>
</body>
</html>