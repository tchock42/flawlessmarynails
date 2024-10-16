<main class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo; ?></h1>
        <p class="barrita__descripcion">En Flawless Mary Nails nos hemos capacitado para ofrecerte los mejores y mas avanzados servicios, con la mejor atención e higiene en técnicas de manicura. Estos son los servicios con los que contamos.</p>
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


<a class="servicios__button" href="https://wa.me/525542181678" target="_blank">
    <button class="servicios__button__agenda">Agenda!</button>
</a>