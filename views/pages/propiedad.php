<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <img src="/uploads/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">
    <div class="resumen-propiedad">
        <p class="precio"><?php echo "$" . number_format($propiedad->precio, 0, ',', '.'); ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="/build/img/icono_wc.svg" alt="Icono wc">
                <p><?php echo $propiedad->wc ?></p>
            </li>

            <li>
                <img class="icono" src="/build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>

            <li>
                <img class="icono" src="/build/img/icono_dormitorio.svg" alt="Icono wc">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?></p>
    </div>
    <div class="">
        <a href="/propiedades" class="boton-verde-block">Ver todas las propiedades</a>
    </div>
</main>