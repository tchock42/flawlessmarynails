<!--Menu emergente-->
<input type="checkbox" id="menu-control" class="menu-control">  <!-- input checkbox-->
    <aside class="sidebar">
        <nav class="sidebar__menu">
            <a href="/">Inicio</a>
            <a href="/servicios">Servicios</a>
            <a href="/productos">Productos</a> <!--esto será la tienda-->
            <a href="/contacto">Contacto</a>
        </nav>
        <label for="menu-control" class="sidebar__close"></label>   <!-- otra etiqueta quees para checkbox como equis -->

        <nav class="menu-redes">
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://www.facebook.com/flawlessmarynails">
                <span class="menu-redes__ocultar">Facebook</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://www.instagram.com/flawlessmarynails/">
                <span class="menu-redes__ocultar">Instagram</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://www.tiktok.com/@flawlessmarynails">
                <span class="menu-redes__ocultar">Tiktok</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://wa.me/525542181678">
                <span class="menu-redes__ocultar">WhatsApp</span>
            </a>
        </nav>
    </aside>
    <!--termina menu emergente-->
    <div class="header__contenedor">
        <div class="header__logo">    <!--aqui va la imagen del logo-->
            <img src="/build/img/logo.jpg" alt="logo flawlessmarynails">
        </div>

        <nav class="header__navegacion">
            <a href="/" class="header__enlace">Inicio</a>
            <a href="/servicios" class="header__enlace">Servicios</a>
            <a href="/productos" class="header__enlace">Productos</a> <!--esto será la tienda-->
            <a href="/contacto" class="header__enlace">Contacto</a>
        </nav>
        
        <nav class="header__iconos">
            <a href="https://wa.me/525542181678" target="_blank"><button class="header__boton">Agendar</button></a>
            <div class="header__user">
                <a class="header__user__icono" href=<?php if(is_auth() && $_SESSION['admin']){ echo '/admin'; }elseif(is_auth() && $_SESSION['nombre']){ echo "/cuenta-usuario"; }else{ echo "/login";} ?>>
                    <button class="header__boton--transparente" type="button">
                        <p class="header__user__login"><?php if(is_auth()){ echo $_SESSION['nombre']; ?> </p> 
                        <?php }else{  ?>
                            <p class="header__user__login">Login</p>
                        <?php } ?>
                            
                        <img src="/build/img/icons/icons8-usuario-femenino-50.png" alt="usuario icono">
                    </button> <!--aqui va un icono de usuario-->
                </a>
                <!-- Mini Submenu | Si está autenticado aparece menú-->
                <?php if(is_auth()){ ?> 
                    <div class="submenu">
                        <a href="/cuenta-usuario"><li class="submenu__elemento"><img src="/build/img/icons/user-solid.svg" alt="usuario icono">Cuenta</li></a>
                        <form method="POST" action="/logout" class="submenu__form">
                            <img src="/build/img/icons/sign-out-alt-solid.svg" alt="icono cerrar sesión"><input type="submit" value="Cerrar Sesión" class="submenu__submit submenu__elemento">
                        </form>
                    </div>
                <?php }else{ ?>
                    <div class="submenu">
                        <a href="/login"><li class="submenu__elemento"><img src="build/img/icons/user-solid.svg" alt="usuario icono">Iniciar Sesión</li></a>
                        <a href="/crear"><li class="submenu__elemento"><img src="build/img/icons/sign-in-alt-solid.svg" alt="icono sign-in">Registrarse</li></a>
                    </div>
                <?php } ?>
            </div>
                <!--Termina minisubmenu-->
            <a href="/carrito" class="header__icono"><img src="/build/img/icons/icons8-shopping-bag-50.png" alt="icono bolsa de compras"></a>
            <label for="menu-control" class="hamburguer">
                <img class="hamburger__icon" src="/build/img/icons/menu.svg" alt="menu desplegable">
            </label>           
        </nav>

        
    </div>