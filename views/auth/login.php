<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php include __DIR__ . "/errores.php"; ?>

    <form class="formulario" method="post" action="/iniciarsesion">
        <fieldset>
            <legend>Identificate</legend>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu email" autocomplete="off"  value="">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" autocomplete="off" >

            <input type="submit" class="boton-verde-block" value="Iniciar sesión">
        </fieldset>
    </form>
</main>