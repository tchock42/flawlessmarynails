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
                <p class="producto__resumen__descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam saepe odio, ut dicta quos sint repudiandae ea inventore voluptatibus.</p>
                <h4>$<span><?php echo $producto->precio; ?></span>MX</h4>
            </div>
            <button 
                type="button" 
                class="producto__agregar"
                data-id="<?php echo $producto->id; ?>"
            >Agregar al carrito</button>
        </div>
    
        <?php } ?>
    </div>

    <section class="carrito" id="carrito">
    <div class="carrito__header">
        <h2>Tu Carrito</h2>
    </div>

    <div class="carrito__items" id="carrito__items">
        
        <div class="carrito__item">
            <img src="/imagenes/producto1.jpeg" class="carrito__item__img">
            <div class="carrito__item__detalles">
                <span class="carrito__item__titulo">Box Engasse</span>
                <!-- <div class="selector__cantidad">
                    <i class="fa-solid fa-minus restar-cantidad"></i>
                    <input type="text" value="1" class="carrito__item__cantidad" disabled>
                    <i class="fa-solid fa-plus sumar-cantidad"></i>
                </div> -->
                <span class="carrito__item__precio">$20,000</span>
            </div>
            <span class="carrito__item__eliminar">
                <i class="fa-solid fa-trash"></i>
            </span>
        </div>
    </div>

    <div class="carrito__total">
        <div class="carrito__total__fila">
            <strong>Tu Total</strong>
            <span class="carrito__total__cantidad">
                
            </span>
        </div>
        <button type="button" class="carrito__total__boton">Pagar
            <li class="fa-solid fa-bag-shopping"></li>
        </button>
    </div>
</section>

</section>


<a class="servicios__button" href="https://wa.me/525542181678" target="_blank">
    <button class="servicios__button__agenda">Agenda!</button>
</a>