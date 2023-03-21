<main class="contenedor seccion">
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>

    <?php
    if ($mensaje) { ?>
        <p class="alerta exito">
            <?php echo $mensaje; ?>
            <span title="Cerrar" class="cerrar">x</span>
        </p>
    <?php
    }

    if ($mensaje_error) { ?>
        <p class="alerta error">
            <?php echo $mensaje_error; ?>
            <span title="Cerrar" class="cerrar">x</span>
        </p>
    <?php } ?>

    <form method="post" class="formulario">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="contacto[nombre]" placeholder="Ingresa tu nombre" autocomplete="off" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="contacto[email]" placeholder="Ingresa tu email" autocomplete="off" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje" placeholder="Escribe tu mensaje aquí..."></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select name="contacto[opciones]" id="opciones" required>
                <option value="" selected disabled hidden>Selecciona una operacion</option>
                <option value="comprar">Comprar</option>
                <option value="vender">Vender</option>
            </select>

            <label for="presupuesto">Presupuesto:</label>
            <input type="number" id="presupuesto" name="contacto[presupuesto]" placeholder="Ingresa tu presupuesto" autocomplete="off" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser Contactado</p>
            <div class="forma-contacto">
                <input type="radio" name="contacto[contacto]" value="telefono" id="contactar-telefono" autocomplete="off" required>
                <label for="contactar-telefono">Teléfono</label>

                <input type="radio" name="contacto[contacto]" value="email" id="contactar-email" autocomplete="off" required>
                <label for="contactar-email">E-mail</label>
            </div>

            <div id="contacto"></div>


        </fieldset>

        <input type="submit" class="boton-verde" value="Enviar">
    </form>
</main>