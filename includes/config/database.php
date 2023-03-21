<?php

declare(strict_types=1);

function conectarDB(): mysqli
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'bienes-raices';

    $db = new mysqli($host, $user, $pass, $bd);

    if (!$db) {
        echo "Hubo un error al conectarse a la db";
        die();
    }

    return $db;
}
