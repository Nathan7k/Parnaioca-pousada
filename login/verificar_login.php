<?php
    session_start();
    include '../app/config/config.php';
    include '../app/config/conexao.php';

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM funcionarios WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) ==1 ){
     $row = mysqli_fetch_array($result);
     $_SESSION['perfil'] = $row['perfil'];
    $_SESSION['email'] = $row['email'];
     header('Location:../app/funcionarios/painel.php');
    } else {
        $msg="Usuário ou senha inválidos" . mysqli_error($con);
        session_destroy();
         header("Location: index.php?msg=$msg");
    }

?> 