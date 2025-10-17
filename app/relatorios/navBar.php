<?php 
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Personalizada</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="../assets/css/root.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-3" href="../funcionarios/home.php">Home</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'financeiro.php') ? 'active' : '' ?>" href="./financeiro.php">Financeiro</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'relatorio_clientes.php') ? 'active' : '' ?>" href="./relatorio_clientes.php">Clientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($pagina_atual == 'logs.php') ? 'active' : '' ?>" href="./logs.php">Logs</a>
                    </li>






    </nav>
</body>

</html>