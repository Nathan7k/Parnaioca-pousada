<!DOCTYPE html>
<html lang="pt-br">
<?php
    include '../config/conexao.php';
    include '../funcionarios/painel.php';?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cadastro-clientes.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="<?PHP echo BASEF; ?>/app/assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="<?PHP echo BASEF; ?>/app/assets/js/cidades-estados-v0.2.js"></script>
    <title>Document</title>
</head>
<body>

    <?php

    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }

    ?>
    <main class="container">
    <section>
        <h1>Cadastrar Cliente</h1>

        <form action="salvar-c.php" method="post">
    <!-- Linha 1: Nome e Data de Nascimento -->
    <div class="input-row">
        <div class="input-box">
            <label>Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
        </div>
        <div class="input-box">
            <label>Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
        </div>
    </div>

    <!-- Linha 2: CPF e Email -->
    <div class="input-row">
        <div class="input-box">
            <label>CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
        </div>
        <div class="input-box2">
            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
        </div>
    </div>

    <!-- Linha 3: Telefone -->
    <div class="input-row">
        <div class="input-box2">
            <label>Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx" required>
        </div>
    </div>

    <!-- Linha 4: Estado e Cidade -->
    <div class="input-row">
        <div class="input-box2">
            <label>Estado</label>
            <select id="estado" name="estado" required class="local"></select>
        </div>
        <div class="input-box2">
            <label>Cidade</label>
            <select id="cidade" name="cidade" required class="local"></select>
        </div>
    </div>

    <button type="submit" class="login">Cadastrar</button>
</form>

    </section>
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