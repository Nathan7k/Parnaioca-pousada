<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <section>
        <h2> Editar funcionário</h2>
        <form action="atualizar-c.php" method="post">
            <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $array['nome'] ?>">

            <label>Data de nascimento </label>
            <input type="text" name="data_nascimento" value="<?php echo $array['data_nascimento'] ?>">

            <label>Cpf</label>
            <input type="text" name="cpf" value="<?php echo $array['cpf'] ?>">
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $array['email'] ?>">
            
            <label>Telefone</label>
            <input type="text" name="senha" value = "<?php echo $array['telefone']?>">

             <label>Estado</label>
            <select type="text" id="estado" name="estado" value = "<?php echo $array['estado']?>"> </select> 

            <label>Cidade</label>
            <select type="text" id="cidade" name="cidade" type="text" id="estado" name="estado" value = "<?php echo $array['cidade']?>">  > </select>
            
            <label>Status</label>
            <select name="stat">
                <option value="ativo" <?php if ($array['ativo'] == 'ativo') {
                                            echo "selected";
                                        } ?>>Ativo</option>
                <option value="inativo" <?php if ($array['ativo'] == 'inativo') {
                                                echo "selected";
                                            } ?>>Inativo</option>
            </select>


            <button type="submit">Atualizar</button>
    </section>
</body>

</html>