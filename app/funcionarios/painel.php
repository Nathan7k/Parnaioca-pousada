<?php
include '../config/config.php';
session_start();

if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'admin') {

?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <title>Painel do Administrador</title>
    </head>

    <body>

        <nav class="sidebar">
            <div class="logo">
                <h2>Painel</h2>
            </div>
            <ul class="nav-links">
                <li><a href="<?= BASEF ?>/app/funcionarios/painel.php">Home</a></li>
                <li><a href="<?= BASEF ?>/app/funcionarios/cadastrar-f.php">Cadastrar Funcionário</a></li>
                <li><a href="listar-f.php">Listar Funcionários</a></li>
                <li><a href="../clientes/listar-c.php">Lista de Clientes</a></li>
                <li><a href="<?= BASEF ?>/app/clientes/cadastrar-clientes.php">Cadastrar Clientes</a></li>
                <li><a href="../reservas/acomodacoes.php">Realizar Reserva</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/estacionamento.php">Controle estacionamento</a></li>
                <li><a href="../frigobar/itens-frigobar.php">Tabela frigobar</a></li>

                <li><a href="../../login/logout.php">Sair</a></li>
            </ul>
        </nav>
    </body>

    </html>
<?php
} elseif (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'user') {
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Painel do Administrador</title>
    </head>

    <body>
        <nav class="sidebar">
            <div class="logo">
                <h2>Painel</h2>
            </div>
            <ul class="nav-links">
                <li><a href="painel.php">Home</a></li>
                <li><a href="../clientes/listar-c.php">Lista de Clientes</a></li>
                <li><a href="../clientes/cadastrar-clientes.php">Cadastrar Clientes</a></li>
                <li><a href="../reservas/acomodacoes.php">Realizar Reserva</a></li>
                <li><a href="../../login/logout.php">Sair</a></li>
            </ul>
        </nav>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php?msg=" . urlencode($msg));
}
?>