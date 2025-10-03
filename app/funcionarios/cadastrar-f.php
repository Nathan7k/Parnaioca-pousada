<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navbar-cadastros.css">
    <link rel="stylesheet" href="../assets/css/cadastros.css">
    <title>Document</title>
</head>
<?php
    include '../config/conexao.php';
    include '../funcionarios/navbar-listas.php';

    if(isset($_GET['msg'])){
        echo $_GET['msg'];
    }

    ?>

<body>
    <main class = "container">
    <section>
        <form action = "salvar-f.php" method = "post">
            <h1>Cadastrar Funcionário</h1>
            
            <div class="input-box">
                <label class="label">Nome completo</label>
                <input type="text" name="nome" placeholder="Nome">
            </div>

            <div class="input-box">
                <label class="label">Email</label>
                <input type="email" name="email" placeholder="Email">
            </div>

            <div class="input-box">
                <label class="label">Senha</label>
                <input type="password" name="senha" placeholder="Senha">
            </div>

            <div class="perfil">
                <select name="perfil" class="perfil">
                    <option value="user">Funcionário</option>
                    <option value="admin">Administrador</option>
                    
                </select>
            </div>
            
            <button type="submit" class="login">Enviar</button>
        </form>
    </section>
    </main>

    
</body>
</html>