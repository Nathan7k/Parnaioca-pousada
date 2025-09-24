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

    $id_acomodacao = $_GET['id'];

    $sql = "SELECT * FROM acomodacoes WHERE id = $id_acomodacao";
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>

    <section>
        <h2> Editar funcionário</h2>
        <form action="atualizar-a.php" method="post">
            <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

            <label>Tipo</label>
            <input type="text" name="tipo_id" value="<?php echo $array['tipo_id'] ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $array['nome'] ?>">

            <label>numero</label>
            <input type="text" name="numero" value="<?php echo $array['numero'] ?>">
            
            <label>valor</label>
            <input type="number" name="valor" value="<?php echo $array['valor'] ?>">
            
            <label>Capacidade máxima</label>
            <input type="text" name="capacidade_maxima" value = "<?php echo $array['capacidade_maxima']?>">
            
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