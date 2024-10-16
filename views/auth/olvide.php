<section class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading">Reestablecer Contraseña</h1>
        <p class="barrita__descripcion">Aqui puedes recuperar tu contraseña usando el correo electrónico con el que te registraste en Flawless Mary Nails. Al enviar el formulario revisa tu bandeja de entra o spam.</p>
    </div>
</section>

<section class="contenedor-formulario">
    <form class="formulario" method="POST" action="/olvide"> <!--ACTION referencia a / -->
        <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
        <div class="campo">
            <label for="email">Tu correo</label>
            <input 
                type="email" 
                id="email" 
                placeholder="ejemplo@correo.com"
                name="email" 
                value = "" 
            >
        </div>
        <input type="submit" class="boton" value="Recuperar contraseña">
    </form>
    <div class="acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? ¡Inicia sesión!</a>
        <!-- <a class="acciones__enlace" href="/crear">Si no tienes, ¡crea una!</a> -->
    </div> 
</section>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>