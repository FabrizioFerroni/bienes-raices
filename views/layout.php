<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)){
    $inicio = false;
}

if(!isset($login)){
    $login = false;
}

// $login = true;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="shortcut icon" href="/../build/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="/build/css/normalize.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Menu">
                </div>

                <div class="derecha">
                    <div>
                        <img src="/build/img/dark-mode.svg" alt="Dark mode" class="dark-mode-boton">

                    </div>
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php
                        if ($auth) {
                        ?>
                            <a href="/admin">Panel</a>
                            <a href="/cerrarsesion">Cerrar Sesion</a>
                        <?php

                        } else {
                        ?>
                            <a href="/iniciarsesion">Iniciar Sesion</a>
                        <?php
                        }
                        ?>
                    </nav>
                </div>
            </div>
            <!-- Fin div barra-->
            <?php if ($inicio) { ?>
                <h1>Ventas de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>
    <?php echo $contenido; ?>
    <footer class="footer seccion <?php echo $login ? 'login' : ''; ?>">
        <div class=" contenedor contenido-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
                <?php
                if ($auth) {
                ?>
                    <a href="/admin">Panel</a>
                    <a href="/cerrarsesion">Cerrar Sesion</a>
                <?php

                } else {
                ?>
                    <a href="/iniciarsesion">Iniciar Sesion</a>
                <?php
                }
                ?>

            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2023-<?php echo date('Y'); ?> &copy</p>
    </footer>
    <script src="/../build/js/bundle.min.js"></script>
</body>

</html>