<?php

$login = true;

$resultado = $_SESSION['resultado'] ?? '';


unset($_SESSION['resultado']);
?>
<main class="contenedor seccion" >
<h1>Panel de administración</h1>
<?php if ($resultado === 'ok') {
    ?>
        <p class="alerta exito">
            <?php echo $_SESSION["mensaje"]; ?>
            <span title="Cerrar" class="cerrar">x</span>
        </p>
    <?php
    }
    ?>
    <?php if ($resultado === 'error') {
    ?>
        <p class="alerta error">
            <?php echo $_SESSION["mensaje"]; ?>
            <span title="Cerrar" class="cerrar">x</span>
        </p>
    <?php
    } ?>
    <div class="d-flex alg-cent-flex">
        <div class="anuncio" width="250" height="154">
            <img src="../build/img/propiedades.jpg" alt="ver propiedades" loading="lazy">
            <a href="/admin/propiedades" style="margin-top: 0rem;" class="boton-amarillo-block">Ver Propiedades</a>
        </div>
        <div class="anuncio">
            <img src="../build/img/vendedor.jpg" alt="ver vendedores" loading="lazy">
            <a href="/admin/vendedores" style="margin-top: 0rem;" class="boton-verde-block">Ver Vendedores</a>
        </div>
    </div>
</main>