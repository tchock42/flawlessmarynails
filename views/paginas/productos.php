<main class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo; ?></h1>
        <p class="barrita__descripcion">Los sets de press-on son uñas reutilizables ideales para ser usadas varias veces el tiempo que tu lo desees. Nuestros set de press-on son creadas de manera artesanal y acorde a la medida de tus uñas. Si deseas conocer más acerca de las uñas reutilizables press-on, da clic en el siguiente enlace: <a href="/press-on" class="boton-vermas"><span>Ver más &raquo;</span></a></p>
    </div>
</main>


<section class="tienda">

    <div class="tienda__listado" id="tienda__listado">
        <?php foreach($productos as $producto){ ?> 
        <div class="producto">
            <img src="/imagenes/<?php echo $producto->imagen; ?>.jpeg" alt="<?php echo $producto->nombre; ?>">
            <div class="producto__resumen">
                <h3><?php echo $producto->nombre; ?></h3>
                <!-- <p class="producto__resumen__descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam saepe odio, ut dicta quos sint repudiandae ea inventore voluptatibus.</p> -->
                <h4>$<span><?php echo $producto->precio; ?></span> MX</h4>
            </div>
            <a href="/producto?id=<?php echo $producto->id; ?>">
            <button 
                type="button" 
                class="producto__agregar"
                data-id="<?php echo $producto->id; ?>"
            >Ver producto</button></a>
        </div>
    
        <?php } ?>
    </div>

</section>


<a class="servicios__button__agenda" href="https://wa.me/525542181678" target="_blank">
   Agenda!
</a>