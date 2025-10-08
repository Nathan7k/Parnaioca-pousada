<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parnaioca - Login</title>
    <link rel="stylesheet" href="app/assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
</head>

<?php
include 'app/config/config.php';
include 'app/config/conexao.php';
?>

<body>
    <div class="login-container">
        <div class="login-box">
            
            
            <div class="login-form">
                <h1 class="brand">Parnaioca</h1>
                <h2>Bem-vindo!</h2>
                <p>Faça login para acessar o sistema</p>

                <form action="login/verificar_login.php" method="post">
                    <div class="input-box">
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>

                    <div class="input-box">
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>

                    <button type="submit" class="login">Entrar</button>

                    <?php
                    if (isset($_GET['msg'])) {
                        echo "<p class='msg-erro'>" . htmlspecialchars($_GET['msg']) . "</p>";
                    }
                    ?>
                </form>

                <p class="footer">© <?= date('Y') ?> Parnaioca</p>
            </div>

           
            <div class="login-image"></div>
        </div>
    </div>
</body>
</html>