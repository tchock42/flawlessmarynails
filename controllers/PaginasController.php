<?php

namespace Controllers;
use MVC\Router;
use Model\Producto;

//paginas publicas como /
class PaginasController{

    public static function index(Router $router){

        $router->render('paginas/index', [
            'titulo' => 'Inicio'
        ]);
    }

    public static function servicios(Router $router){

        $router->render('paginas/servicios',[
            'titulo' => 'Servicios'
        ]);
    }

    public static function contacto(Router $router){

        $router->render('paginas/contacto',[
            'titulo' => 'Contacto'
        ]);
    }

    public static function productos(Router $router){   // tienda de press-on

        $productos = Producto::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
            
        }
        $router->render('paginas/productos', [
            'titulo' => 'Sets de Press-On',
            'productos' => $productos,
            'nombre' => $_SESSION['nombre'] ?? '',
            'apellido' => $_SESSION['apellido'] ?? '',
            'id' => $_SESSION['id'] ?? ''
        ]);
    }  

    public static function pedido(Router $router){ //pagina para realizar el pago
        if(!isset($_SESSION)) { //si no está la sesion abierta la abre
            session_start();
        }
        if(!isset($_SESSION['id'])){ // si no está iniciada la sesión
            header('Location: /login?redirect=/pedido');
            exit();
        }

        $router->render('paginas/pedido', [
            'titulo' => 'Proceso de Pago',
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'id' => $_SESSION['id']
        ]);
    }
}

