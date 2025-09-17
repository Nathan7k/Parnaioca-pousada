<!DOCTYPE html>
<html lang="pt-br">
<?php include '../config/config.php' ?>

<head>
    <meta charset="UTF-8">



    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <section>
        <h1>Cadastrar Cliente</h1>

        <form action="salvar-c.php" method="post">

            <label>Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome completo" required> </br>


            <label>Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required> </br>

            <label>CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" required> </br>

            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required> </br>

            <label>Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx" required> </br>

            <label>Estado</label>
            <select type="text" id="estado" name="estado" required></select> </br>

            <label>Cidade</label>
            <select type="text" id="cidade" name="cidade" required> </select> </br>

            <button type="submit">Cadastrar</button>

    </section>


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