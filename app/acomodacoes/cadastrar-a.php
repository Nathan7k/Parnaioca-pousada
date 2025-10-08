<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Document</title>
</head>
<?php
include '../config/conexao.php';

?>

<body>
    <main class="container">
        <section>
            <form action="salvar-a.php" method="post">
                <h1 class="txth2">Cadastrar Acomodação</h1>

                <div class="input-box">
                    <label class="label">Nome</label>
                    <input type="text" name="nome" placeholder="Nome">
                </div>

                <div class="input-box">
                    <label class="label">tipo</label>
                    <input type="text" name="tipo_id" placeholder="Tipo">
                </div>

                <div class="input-box">
                    <label class="label">Valor</label>
                    <input type="number" name="valor" placeholder="valor">
                </div>

                <div class="input-box">
                    <label class="label">Capacidade máxima</label>
                    <input type="number" name="capacidade_maxima" placeholder="capacidade máxima">
                </div>

                <div class="input-box">
                    <label class="label">Quantidade de vagas</label>
                    <input type="number" name="quantidade_vagas" id="quantidade_vagas" min="0" required placeholder="quantidade de vagas">
                </div></br></br>

                <button class="bt_confirm" type="submit" class="login">Enviar</button>
                <button class="btn_return" type="button" class="login" onclick="location.href='listar-a.php'">Voltar</button>
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