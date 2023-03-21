<?php
$numero = count($propiedades);

// $resultado = $_SESSION['resultado'] ?? '';

// debug($_SESSION['resultado']);
unset($_SESSION['resultado']);
?>

<main class="contenedor seccion">
    <h1>Administrador de propiedades</h1>

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

    <a href="/admin/propiedades/crear" class="boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar los resultados -->
            <?php
            if ($numero == 0) { ?>
                <tr>
                    <td class="no-anuncio" colspan="5">No hay anuncios para mostrar</td>
                </tr>
                <?php
            } else {
                foreach ($propiedades as $propiedad) {

                ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="../uploads/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad" class="imagen-tabla"></td>
                        <td><?php echo "$" . number_format($propiedad->precio, 0, ',', '.'); ?></td>
                        <td>
                            <a href="/admin/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                            <form action="/admin/propiedades/eliminar" method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
    <a href="/admin" class="boton-verde">Volver</a>

</main>