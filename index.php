<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parnaioca</title>
    <link rel="stylesheet" href="app/assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<?php
include 'app/config/config.php';
include 'app/config/conexao.php';
?>

<body>
    
    <main class ="container">
        <form action="login/verificar_login.php" method="post">

            <h1>Parnaioca</h1>

            <div class="input-box">
                <input type="email" name="email" placeholder="E-mail"></br>
            </div>

            <div class="input-box">
                <input type="password" name="senha" placeholder="Senha">
            </div>

            <button type="submit" class = "login">Entrar</button>

            <?php
            if (isset($_GET['msg'])) {
                echo "<p style='color:red'>" . $_GET['msg'] . "</p>";
            }
            ?>

        </form>
    
    </main>
</body>

</html>