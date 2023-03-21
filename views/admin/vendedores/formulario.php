<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" autocomplete="off" placeholder="Ingrese el nombre del vendedor" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" autocomplete="off" placeholder="Ingrese el apellido del vendedor" value="<?php echo s($vendedor->apellido); ?>">



</fieldset>
<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Teléfono:</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" autocomplete="off" placeholder="Ingrese el telefono del vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>