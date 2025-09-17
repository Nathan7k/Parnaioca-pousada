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
    $id_funcionario = $_GET['id'];
    $sql = "DELETE FROM funcionarios WHERE id = $id_funcionario";
    $deletar = mysqli_query($con, $sql);    
    if($deletar){
        echo "<script>alert('Deletado com sucesso!'); location.href='listar-f.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar!'); location.href='listar-f.php';</script>";
    }
?>
</body>
</html>