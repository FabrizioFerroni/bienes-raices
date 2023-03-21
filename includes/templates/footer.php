<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>
<footer class="footer seccion <?php echo $login ? 'login' : ''; ?>"">
    <div class=" contenedor contenido-footer">
    <nav class="navegacion">
        <a href="/nosotros">Nosotros</a>
        <a href="/anuncios">Anuncios</a>
        <a href="/blog">Blog</a>
        <a href="/contacto">Contacto</a>
        <?php
                        if ($auth) {
                        ?>
                            <a href="/admin/">Panel</a>
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
<script src="/build/js/bundle.min.js"></script>
</body>

</html>