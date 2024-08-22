<?php
// debuguear($alertas);
foreach($alertas as $key => $alerta){   // accede al key de la alerta
    foreach($alerta as $mensaje){       // accede al value
?>
    <p class="alerta alerta__<?php echo $key; ?>"><?php echo $mensaje; ?></p>       
<?php
    }
}