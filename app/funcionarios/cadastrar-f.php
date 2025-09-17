<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    include '../config/conexao.php';

    if(isset($_GET['msg'])){
        echo $_GET['msg'];
    }

    ?>

<body>
    <section>
        <form action = "salvar-f.php" method = "post">
            <input type="text" name="nome" placeholder="Nome">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="senha" placeholder="Senha">
            <select name="perfil">
                <option value="admin">Administrador</option>
                <option value="user">Funcionário</option>
            </select>

            <button type="submit">Enviar</button>
        </form>
    </section>

    
</body>
</html>