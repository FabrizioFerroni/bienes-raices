<main class="contenedor seccion">
    <h1>Crear nuevo vendedor</h1>

    <a href="/admin/vendedores" class="boton-verde">Volver</a>
    <?php include __DIR__ . "/errores.php"; ?>

    <form action="/admin/vendedores/crear" method="POST" class="formulario" >
        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" class="boton-verde" value="Crear">
    </form>
</main>