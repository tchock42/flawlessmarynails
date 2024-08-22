<section class="contenedor encabezado">
    <div class="barrita">
        <h1 class="barrita__heading">Crear Cuenta</h1>
        <p class="barrita__descripcion">Aqui puedes crear una cuenta en Flawless Mary Nails para agendar una cita. O si ya tienes una cuenta en Flawless Mary Nails, solo inicia sesión con tu correo y contraseña.</p>
    </div>
</section>

<section class="contenedor-formulario">

    <form class="formulario" method="POST" action="/crear">
        <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
        <div class="campo">
            <label for="nombre" class="formulario__label">Nombre(s)</label>
            <input type="text"  placeholder="Tu Nombre" id="nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
        </div>

        <div class="campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text"  placeholder="Tu Apellido" id="apellido" name="apellido" value="<?php echo $usuario->apellido; ?>">
        </div>

        <div class="campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="text"  placeholder="Tu Email" id="email" name="email" value="<?php echo $usuario->email; ?>">
        </div>
        <div class="campo">
            <label for="telefono" class="formulario__label">Teléfono</label>
            <input type="text"  placeholder="Tu teléfono" id="telefono" name="telefono" value="<?php echo $usuario->telefono; ?>">
        </div>
        <div class="campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password"  placeholder="Tu contraseña" id="password" name="password">
        </div>
        <div class="campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input type="password"  placeholder="Repetir contraseña" id="password2" name="password2">
        </div>
        <input type="submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes Cuenta? Inicia Sesión</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</section>
<div class=" formulario-imagen">
    <img src="/build/img/pexels-ds-stories-7256115.jpg" alt="imagen brochas nail art">
</div>