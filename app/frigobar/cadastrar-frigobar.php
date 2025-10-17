<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Document</title>
</head>
<?php
    include '../config/conexao.php';
   
    
    

    ?>

<body>
    <main class = "container">
    <section>
        <form action = "salvar-frigobar.php" method = "post">
            <h1 class="txth2">Cadastrar Item</h1>

            <div class="input-box">
                <label class="label">Nome do item</label>
                <input type="text" name="nome" placeholder="Nome">
            </div>

             <div class="input-box">
                <label class="label">valor</label>
                <input type="number" name="valor" placeholder="valor" min = 0>
            </div></br></br>

            
            
            <button class="bt_confirm" type="submit" class="login">Enviar</button>
            <button class="btn_return" type="button" class="login" onclick="location.href='itens-frigobar.php'">Voltar</button>
        </form>

    </section>
<?php
    if(isset($_GET['msg'])){
        echo $_GET['msg'];
    }
    ?>
    </main>

    
</body>
</html>