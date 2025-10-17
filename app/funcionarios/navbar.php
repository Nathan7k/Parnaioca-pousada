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

        <title>Painel de Controle</title>
    </head>

    <body>

        <nav class="sidebar">
            <div class="logo">
                <h2>Parnaioca</h2>
            </div>
            <ul class="nav-links">
                <li><a href="<?= BASEF ?>/app/funcionarios/home.php">Home</a></li>
                <li><a href="<?= BASEF ?>/app/funcionarios/listar-f.php">Funcionários</a></li>
                <li><a href="<?= BASEF ?>/app/clientes/listar-c.php">Clientes</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/hospedes.php">Hospedes</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/acomodacoes.php">Reserva</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/estacionamento.php">Estacionamento</a></li>
                <li><a href="<?= BASEF ?>/app/frigobar/itens-frigobar.php">Frigobar</a></li>
                <li><a href="<?= BASEF ?>/app/acomodacoes/listar-a.php">Acomodações</a></li>
                <li><a href="<?= BASEF ?>/app/relatorios/financeiro.php">Relatórios</a></li>

                <li><a href="../../login/logout.php">Sair</a></li>
            </ul>
        </nav>

        <div>
        </div>
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <title>Painel de Controle</title>
    </head>

    <body>

        <nav class="sidebar">
            <div class="logo">
                <h2>Parnaioca</h2>
            </div>
            <ul class="nav-links">
                <li><a href="<?= BASEF ?>/app/funcionarios/home.php">Home</a></li>
                <li><a href="<?= BASEF ?>/app/clientes/listar-c.php">Clientes</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/hospedes.php">Hospedes</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/acomodacoes.php">Reserva</a></li>
                <li><a href="<?= BASEF ?>/app/reservas/estacionamento.php">Estacionamento</a></li>
                <li><a href="<?= BASEF ?>/app/frigobar/itens-frigobar.php">Frigobar</a></li>
                <li><a href="<?= BASEF ?>/app/relatorios/financeiro.php">Relatórios</a></li>

                <li><a href="../../login/logout.php">Sair</a></li>
            </ul>
        </nav>

        <div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php?msg=" . urlencode($msg));
}
?>