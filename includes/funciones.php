<?php

declare(strict_types=1);
// require 'app.php';
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMG', $_SERVER['DOCUMENT_ROOT'] . '\uploads\\');


function incluirTemplate(string $nombre, bool $inicio = false, bool $login = false)
{
    include TEMPLATES_URL .  "/${nombre}.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /iniciarsesion');
    }
}

function debug($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

// Crear slug para los anuncios
function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

// Escapar / sanitizar el html
function s(string $html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function validarORedireccionar(string $mensaje,string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        session_start();
        $_SESSION['resultado'] = "error";
        $_SESSION['mensaje'] = $mensaje;
        header("Location: ${url}");
    }

    return $id;
}
