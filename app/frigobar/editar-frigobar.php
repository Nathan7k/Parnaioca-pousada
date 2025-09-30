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

    $iditens = $_GET['id'];

    $sql = "SELECT * FROM itens_frigobar WHERE id = $iditens";
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>

    <section>
        <h2> Editar itens</h2>
        <form action="atualizar-frigobar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $array['nome'] ?>">
            
            <label>Valor</label>
            <input type="valor" name="valor">

            <label>Status</label>
            <select name="ativo">
                <option value="1" <?php if ($array['ativo'] == 'ativo') {
                                            echo "selected";
                                        } ?>>Ativo</option>
                <option value="0" <?php if ($array['ativo'] == 'inativo') {
                                                echo "selected";
                                            } ?>>Inativo</option>
            </select>


            <button type="submit">Atualizar</button>
    </section>
</body>

</html>