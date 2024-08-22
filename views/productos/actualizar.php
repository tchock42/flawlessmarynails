<main class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo; ?></h1>
        <p class="barrita__descripcion">Buenos días Mary, actualiza el set de uñas.</p>
    </div>
</main>

<section class="contenedor-formulario producto">
    <a href="/admin" class="contenedor-formulario__boton-volver"> < Regresar</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">  
        <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
        <div class="campo">
            <label for="nombre" class="formulario__label">Nombre del Set</label>
            <input type="text"  placeholder="Tu Nombre" id="nombre" name="nombre" value="<?php echo $producto->nombre; ?>">
        </div>

        <div class="campo">
            <label for="descripcion" class="formulario__label">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción del Producto"><?php echo $producto->descripcion; ?></textarea>
        </div>

        <div class="campo">
            <label for="precio" class="formulario__label">Precio</label>
            <input type="text"  placeholder="Tu Email" id="precio" name="precio" value="<?php echo $producto->precio; ?>">
        </div>
        <div class="campo">
            <label for="imagen">Imagen:</label>
            <input class="campo__boton" type="file" id="imagen" accept="image/jpeg image/png" name="imagen">
        </div>
        <?php if(isset($producto->imagen_actual)){ ?>
        <div class="campo">
            <p class="formulario__texto">Imagen Actual:</p>
            <div class="formulario__imagen">
                <picture>   
                        <source srcset="/imagenes/<?php echo $producto->imagen; ?>.webp" type="image/webp" >
                        <img src="/imagenes/<?php $producto->imagen; ?>.jpeg" alt="Imagen del ponente">
                </picture>
            </div>
        </div>

    <?php } ?>
        <input type="submit" value="Actualizar Producto">
    </form>

</section>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>