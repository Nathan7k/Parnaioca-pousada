<?php

include  '/laragon/www/parnaioca/required.php';

$con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
mysqli_select_db($con, $_ENV['DB_NAME']);