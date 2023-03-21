<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad){?>
    <div class="anuncio">
            <img src="/uploads/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio"><?php echo "$" . number_format($propiedad->precio, 0, ',', '.'); ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono wc">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="propiedad?slug=<?php echo $propiedad->slug; ?>" class="boton-amarillo-block">Ver propiedad</a>

        </div>
    </div>
    <?php }?>
</div>