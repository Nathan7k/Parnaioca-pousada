<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cadastros.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/css/navbar-cadastros.css">
    <title>Document</title>
</head>
<?php
include '../config/conexao.php';
include '../funcionarios/navbar-listas.php';



?>

<body>
    <main class="container">
        <section>
            <form action="salvar-a.php" method="post">
                <h1>Cadastrar Acomodação</h1>

                <div class="input-box">
                    <input type="text" name="nome" placeholder="Nome">
                </div>

                <div class="input-box">
                    <input type="text" name="tipo_id" placeholder="Tipo">
                </div>

                <div class="input-box">
                    <input type="text" name="numero" placeholder="numero">
                </div>

                <div class="input-box">
                    <input type="number" name="valor" placeholder="valor">
                </div>

                <div class="input-box">
                    <input type="number" name="capacidade_maxima" placeholder="capacidade máxima">
                </div>

                 <div class="input-box">
                <input type="number" name="quantidade_vagas" id="quantidade_vagas" min="0" required placeholder="quantidade de vagas">
                </div>

                <button type="submit" class="login">Enviar</button>
            </form>

        </section>
        <?php
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
        ?>
    </main>


</body>

</html>