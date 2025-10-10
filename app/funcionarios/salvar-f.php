<?php
include '../config/conexao.php';
include '../config/functions.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $perfil = $_POST['perfil'];

    validardados_funcionarios($nome, $email, $senha, $perfil);

    $result = insertFuncionario($con, $nome, $email, $senha, $perfil);

    if ($result === true) {
        
        $id_funcionario = mysqli_insert_id($con);

       
        $usuario_id = $_SESSION['usuario_id'];

       
        registrarLog($con, $usuario_id, "Cadastrou o funcionário $nome", "funcionarios", $id_funcionario);

        
        $msg = "Funcionário cadastrado com sucesso!";
        header("Location: cadastrar-f.php?msg=" . urlencode($msg));
        exit;
    } else {
        echo $result;
    }
} else {
    echo "Método inválido.";
}
?>

