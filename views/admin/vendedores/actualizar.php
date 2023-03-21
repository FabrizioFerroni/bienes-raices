<main class="contenedor seccion">
    <h1>Actualizar vendedor</h1>

    <a href="/admin/propiedades" class="boton-verde">Volver</a>
    <?php include __DIR__ . "/errores.php"; ?>


    <form method="POST" class="formulario" enctype="multipart/form-data">
    <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" class="boton-verde" value="Actualizar">
    </form>

</main>