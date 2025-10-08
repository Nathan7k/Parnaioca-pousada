<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../assets/js/cidades-estados-v0.2.js"></script>


</head>

<?php
include '../config/conexao.php'; ?>

<body>


    <main class="container">
        <section>

            <form action="salvar-c.php" method="post">
                <h1 class="txth2">Cadastrar Cliente</h1>

                <div class="input-box">
                    <label class="label">Nome completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
                </div>

                <div class="input-box">
                    <label class="label">Data de Nascimento</label>
                    <input class="input-date" type="date" id="data_nascimento" name="data_nascimento" required>
                </div>


                <div class="input-box">
                    <label class="label">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
                </div>

                <div class="input-box">
                    <label class="label">Email</label>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>

                <div class="input-box">
                    <label class="label">Telefone</label>
                    <input type="text" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx" required>
                </div>

                <div class="select-c">
                    <label>Estado:</label>
                    <select id="estado" name="estado" required class="local"></select>
                </div>

                <div class="select-c">
                    <label>Cidade:</label>
                    <select id="cidade" name="cidade" required class="local"></select>
                </div>


                <button class="bt_confirm" type="submit" class="login">Cadastrar</button>
                <button class="btn_return" type="button" class="login" onclick="location.href='listar-c.php'">Voltar</button>
            </form>

        </section>

        <?php if (isset($_GET['msg'])): ?>
            <div class="mensagem">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php endif; ?>
    </main>




</body>


<script type="text/javascript">
    $("#telefone").mask("(99) 99999-9999");
    $("#cpf").mask("999.999.999-99");
</script>


<script type="text/javascript">
    window.onload = function() {
        new dgCidadesEstados(
            document.getElementById('estado'),
            document.getElementById('cidade'),
            true
        );
    }
</script>





</html>