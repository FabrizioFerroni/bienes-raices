<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" autocomplete="off" placeholder="Ingrese el titulo de la propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" autocomplete="off" placeholder="Ingrese el precio de la propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="propiedad[imagen]" id="imagen" autocomplete="off" accept="image/jpeg, image/jpg, image/png">

    <?php if ($propiedad->imagen) {
    ?>
        <img src="/public/uploads/<?php echo $propiedad->imagen; ?>" alt="" class="imagen-small">
    <?php
    }
    ?>
    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion" autocomplete="off" placeholder="Ingrese una descripción para la propiedad"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información de la Propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" autocomplete="off" placeholder="Cantidad de habitaciones de la propiedad. Ej: 3" min="0" step="1" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" name="propiedad[wc]" id="wc" autocomplete="off" placeholder="Cantidad de baños de la propiedad. Ej: 3" min="0" step="1" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" autocomplete="off" placeholder="Cantidad de estacionamiento de la propiedad. Ej: 1" min="0" step="1" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>
<fieldset>
    <legend>Información de quien lo vende</legend>
    <label for="vendedores_id">Vendedor:</label>
    <select name="propiedad[vendedores_id]" id="vendedores_id" value="<?php echo s($propiedad->vendedores_id); ?>">
        <option value="" <?php echo $propiedad->vendedores_id === '' ? 'selected' : ''; ?> hidden>Seleccione un vendedor</option>
        <?php
       foreach($vendedores as $vendedor) {
        ?>
            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo $vendedor->id; ?>"><?php echo s($vendedor->nombre) . ' ' . s($vendedor->apellido); ?></option>
        <?php
        }
        ?>
    </select>
</fieldset>