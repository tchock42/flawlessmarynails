<section class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading"><?php echo $titulo; ?></h1>
        <p class="barrita__descripcion">Aquí puedes crear una nueva contraseña para poder iniciar sesión en Flawless Mary Nails y agendar una cita. No olvides guardar tu contraseña para volver a iniciar sesión.</p>
    </div>
</section>

<section class="contenedor-formulario">
    <form class="formulario" method="POST"> <!--ACTION referencia a / -->
        <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <?php if($token_valido){ ?>

        <div class="campo">
            <label for="password">Tu nueva contraseña</label>
            <input 
                type="password" 
                id="password" 
                placeholder="Tu nueva contraseña"
                name="password" 
            >
        </div>
        <div class="campo">
            <label for="password2">Repite la nueva contraseña</label>
            <input 
                type="password" 
                id="password2" 
                placeholder="Repite la nueva contraseña"
                name="password2" 
            >
        </div>
        <input type="submit" class="boton" value="Guardar Contreaseña">
        <?php } ?>
    </form>
    <div class="acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? ¡Inicia sesión!</a>
        <!-- <a class="acciones__enlace" href="/crear">Si no tienes, ¡crea una!</a> -->
    </div> 
</section>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>