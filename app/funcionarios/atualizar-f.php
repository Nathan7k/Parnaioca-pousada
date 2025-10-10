<?php
include '../config/conexao.php';
include '../config/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $perfil = $_POST['perfil'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    $result = updateFuncionario($con, $id, $nome, $email, $senha, $perfil, $ativo);

    if ($result === true) {

        $id_funcionario = $id;

        $usuario_id = $_SESSION['usuario_id'];


        registrarLog($con, $usuario_id, "Atualizou o Cadastro do funcionário $nome", "funcionarios", $id_funcionario);


        echo "<script>alert('funcionário atualizado com sucesso.'); history.back();</script>";
        exit;
    } else {
        echo $result;
    }
} else {
    echo "Método inválido.";
}
