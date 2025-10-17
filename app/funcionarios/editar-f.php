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

    $id_funcionario = $_GET['id'];

    $sql = "SELECT * FROM funcionarios 
            WHERE id = $id_funcionario";
            
    $busca = mysqli_query($con, $sql);
    $array = mysqli_fetch_array($busca);

    ?>
    <main class="container">
        <section>
            <h2 class="txth2"> Editar funcionário</h2>
            <form action="atualizar-f.php" method="post">
                <input type="hidden" name="id" value="<?php echo $array['id'] ?>">

                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $array['nome'] ?>">

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $array['email'] ?>">


                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite a nova senha">

                <div class="select">
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

                <button class="btn_return" type="button" onclick="location.href='listar-f.php'">Voltar</button>
        </section>
    </main>
</body>

</html>