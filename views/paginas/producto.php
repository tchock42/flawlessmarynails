<main class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading">Set de press-on</h1>
        <p class="barrita__descripcion">En Flawless Mary Nails nos hemos capacitado para ofrecerte los mejores y mas avanzados servicios, con la mejor atención e higiene en técnicas de manicura. Checa este set de press-on.</p>
    </div>
</main>

<section class="press-on">
    <div class="press-on__vista">
        <div class="press-on__vista__imagen">
            <img src="/imagenes/<?php echo $producto->imagen; ?>.jpeg" alt="<?php echo $producto->nombre; ?>">
        </div>
        
        <div class="press-on__vista__informacion">
            <h2 class="press-on__vista__informacion__nombre"><?php echo $producto->nombre; ?></h2>
            <p class="press-on__vista__informacion__descripcion"><span>Descripción: </span><?php echo $producto->descripcion; ?></p>
            <p class="press-on__vista__informacion__precio"><span>Precio: </span>$<?php echo $producto->precio; ?>MX</p>
            <div class="press-on__vista__informacion__contacto">
                <p>Ponte en contacto con nosotros para agendar una cita, medir tus uñas y crear un set de uñas reutilizables con el diseño que tu buscas.</p>
                <a href="https://wa.me/525542181678" class="header__boton press-on__vista__informacion__contacto__boton-contacto">¡Contáctame!</a>
            </div>
            
        </div>

        
    </div>
    <a href="/productos" class="press-on__boton-volver">Volver</a>
</section>