<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php';

// Conectarno a la base de datos
$db = conectarDB();

use Model\Principal;


Principal::setDB($db);