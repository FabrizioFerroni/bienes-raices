<?php  
$numero = count($vendedores);
unset($_SESSION['resultado']);
?>

<main class="contenedor seccion">
    <h1>Administrador de vendedores</h1>

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

    <a href="/admin/vendedores/crear" class="boton-verde">Nuevo Vendedor</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar los resultados -->
            <?php
            if ($numero == 0) { ?>
                <tr>
                    <td class="no-anuncio" colspan="5">No hay vendedores para mostrar</td>
                </tr>
                <?php
            } else {
                foreach ($vendedores as $vendedor) {

                ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <a href="/admin/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                            <form action="/admin/vendedores/eliminar" method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
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