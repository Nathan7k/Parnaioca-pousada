<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navbar-cadastros.css">
    <link rel="stylesheet" href="../assets/css/cadastro-clientes.css">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../assets/js/cidades-estados-v0.2.js"></script>

    
</head>

<?php
    include '../config/conexao.php';
    include '../funcionarios/navbar-listas.php';?>
<body>

   
    <main class="container">
    <section>
        <h1>Cadastrar Cliente</h1>

        <form action="salvar-c.php" method="post">
    
    
        <div class="input-box">
            <label>Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
        </div>
        <div class="input-box"  >
            <label>Data de Nascimento</label>
            <input class="input-date" type="date" id="data_nascimento" name="data_nascimento" required>
        </div>
    

        <div class="input-box">
            <label>CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
        </div>
        <div class="input-box2">
            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
        
    </div>

    
    <div class="input-row">
        <div class="input-box2">
            <label>Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx" required>
        </div>
    </div>

   
    <div class="input-row">
        <div class="input-box2">
            <label>Estado</label>
            <select id="estado" name="estado" required class="local"></select>
        </div>
        <div class="input-box2">
            <label>Cidade</label>
            <select id="cidade" name="cidade" required class="local"></select>
        </div>
    </div>

    <button type="submit" class="login">Cadastrar</button>
</form>

    </section>

    <?php if(isset($_GET['msg'])): ?>
    <div class="mensagem">
        <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
<?php endif; ?>
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