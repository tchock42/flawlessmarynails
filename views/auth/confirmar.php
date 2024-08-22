<section class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo;  ?></h1>
        
    </div>
</section>

<?php 
    if(isset($alertas['exito'])){   ?>
        <section class="contenedor-formulario">
            <div class="acciones">
                <a class="acciones__enlace acciones__enlace__confirmar" href="/login">Iniciar sesión</a>
            </div>
        </section>
<?php
    }else{
?>
    <section class="contenedor-formulario">
        <div class="acciones">
            <a class="acciones__enlace acciones__enlace__confirmar" href="/crear">Registrarse</a>
        </div>
    </section>
<?php } ?>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>