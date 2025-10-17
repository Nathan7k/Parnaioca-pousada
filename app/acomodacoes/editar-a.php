<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Document</title>
</head>

<body>
    <?php
    include '../config/conexao.php';
    include '../../login/verificar_permissao.php';

    verificarPerfil(['admin']);

    $id_acomodacao = $_GET['id'];

    $sql = "SELECT * FROM acomodacoes WHERE id = $id_acomodacao";
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>
    <main class="container">
        <section>
            <h2 class="txth2"> Editar acomodação</h2>
            <form action="atualizar-a.php" method="post">
                <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $array['nome'] ?>">

                <label>Tipo</label>
                <input type="text" name="tipo" value="<?php echo $array['tipo'] ?>">
            

                <label>valor</label>
                <input type="number" name="valor" value="<?php echo $array['valor'] ?>">

                <label>Capacidade máxima</label>
                <input type="text" name="capacidade_maxima" value="<?php echo $array['capacidade_maxima'] ?>">

                <label>Status</label>
                <select name="ativo">
                    <option value="1" <?php if ($array['ativo'] == 'ativo') {
                                            echo "selected";
                                        } ?>>Ativo</option>
                    <option value="0" <?php if ($array['ativo'] == 'inativo') {
                                            echo "selected";
                                        } ?>>Inativo</option>
                </select>


                <button class="bt_confirm" type="submit">Atualizar</button>
                <button class="btn_return" type="button" onclick="location.href='listar-a.php'">Voltar</button>
        </section>
    </main>
</body>

</html>