<section class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading">Login</h1>
        <p class="barrita__descripcion">Aqui puedes iniciar sesión para agendar una cita. O si no tienes cuenta en Flawless Mary Nails, puedes crear una.</p>
    </div>
</section>

<section class="contenedor-formulario">
    <form class="formulario" method="POST" action="/login" id="loginForm"> <!--ACTION referencia a / -->
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
        <div class="campo">
            <label for="password">Tu Contraseña</label>
            <input 
                type="password" 
                id="password" 
                placeholder="Al menos 6 caracteres"
                name="password"> <!-- para leerse con $_post['email] -->
        </div>
        <input type="submit" value="Iniciar Sesión" id="loginButton">
    </form>
    <div class="acciones">
        <a class="acciones__enlace" href="/crear">¿Aún no tienes cuenta? Crear cuenta</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</section>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>



