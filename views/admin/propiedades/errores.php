<?php
foreach ($errores as $error) {
?>
    <div class="alerta error" data-id="alert-<?php echo $k; ?>">
        <?php echo $error; ?>
        <span class="cerrar" data-id="cerrar-<?php echo $k; ?>" title="Cerrar">X</span>
    </div>
<?php
}
?>