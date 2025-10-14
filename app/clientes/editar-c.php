<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../assets/js/cidades-estados-v0.2.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include '../config/conexao.php';

    $id_clientes = $_GET['id'];

    $sql = "SELECT * FROM clientes WHERE id = $id_clientes";
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>
    <main class="container">
        <section>

            <h2 class="txth2"> Editar funcionário</h2>
            <form action="atualizar-c.php" method="post">
                <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $array['nome'] ?>">

                <label>Data de nascimento </label>
                <input type="date" name="data_nascimento" value="<?php echo $array['data_nascimento'] ?>">

                <label>Cpf</label>
                <input id="cpf" type="text" name="cpf" value="<?php echo $array['cpf'] ?>">

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $array['email'] ?>">

                <label>Telefone</label>
                <input id="telefone" type="text" name="telefone" value="<?php echo $array['telefone'] ?>">


                <div class="select-c">
                    <label>Estado:</label>
                    <select type="text" id="estado" name="estado" value="<?php echo $array['estado'] ?>"> </select>

                    <label>Cidade:</label>
                    <select type="text" id="cidade" name="cidade" type="text" id="estado" name="estado" value="<?php echo $array['cidade'] ?>"> > </select>
                </div>
                
                <div class="select-s">
                    <label>Status:</label>
                    <select name="ativo">
                        <option value="ativo" <?php if ($array['ativo'] == 'ativo') {
                                                    echo "selected";
                                                } ?>>Ativo</option>
                        <option value="inativo" <?php if ($array['ativo'] == 'inativo') {
                                                    echo "selected";
                                                } ?>>Inativo</option>
                    </select>
                </div>

                <button class="bt_confirm" type="submit">Atualizar</button>
                <button class="btn_return" type="button" onclick="location.href='listar-c.php'">Voltar</button>
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