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

    $id_funcionario = $_GET['id'];

    $sql = "SELECT * FROM funcionarios WHERE id = $id_funcionario";
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>

    <section>
        <h2> Editar funcionário</h2>
        <form action="atualizar-f.php" method="post">
            <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $array['nome'] ?>">
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $array['email'] ?>">
            
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Digite a nova senha">

            <label>Perfil</label>
            <select name="perfil">
                <option value="admin" <?php if ($array['perfil'] == 'admin') {
                                            echo "selected";
                                        } ?>>Administrador</option>
                <option value="user" <?php if ($array['perfil'] == 'user') {
                                            echo "selected";
                                        } ?>>Funcionário</option>
            </select>
            
            <label>Status</label>
            <select name="stat">
                <option value="ativo" <?php if ($array['Stat'] == 'ativo') {
                                            echo "selected";
                                        } ?>>Ativo</option>
                <option value="inativo" <?php if ($array['Stat'] == 'inativo') {
                                                echo "selected";
                                            } ?>>Inativo</option>
            </select>


            <button type="submit">Atualizar</button>
    </section>
</body>

</html>