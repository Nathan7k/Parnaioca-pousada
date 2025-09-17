<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include '../config/conexao.php';
    $id_cliente = $_GET['id'];
    $sql = "DELETE FROM clientes WHERE id = $id_cliente";
    $deletar = mysqli_query($con, $sql);    
    if($deletar){
        echo "<script>alert('Deletado com sucesso!'); location.href='listar-c.php';</script>";
    } else {
        echo "<script> alert('Erro ao deletar!'); location.href='listar-c.php'; </script>";
    }
?>, initial-scale=1.0">
</body>
</html>