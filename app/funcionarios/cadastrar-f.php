<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Document</title>
</head>


<body>
    <main class="container">
        <section>
            <form action="salvar-f.php" method="post">
                <h1 class="txth2" >Cadastrar Funcionário</h1>

                <div class="input-box">
                    <label class="label">Nome completo</label>
                    <input type="text" name="nome" placeholder="Nome">
                </div>

                <div class="input-box">
                    <label class="label">Email</label>
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div class="input-box">
                    <label class="label">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>

                <div class="perfil">
                    <select name="perfil" class="perfil">
                        <option value="user">Funcionário</option>
                        <option value="admin">Administrador</option>

                    </select>
                </div>

                <button class="bt_confirm" type="submit" class="login">Enviar</button>
                <button class="btn_return" type="button" class="login" onclick="location.href='listar-f.php'">Voltar</button>
            </form>
        </section>
    </main>
    <?php
    include '../config/conexao.php';
    include '../../login/verificar_permissao.php';

    verificarPerfil(['admin']);
    

    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }

    ?>

</body>

</html>