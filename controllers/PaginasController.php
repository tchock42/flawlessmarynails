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

    public static function productos(Router $router){

        $productos = Producto::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('Location: /login');
            }
            
        }
        $router->render('paginas/productos', [
            'titulo' => 'Sets de Press-On',
            'productos' => $productos,
            'nombre' => $_SESSION['nombre'] ?? '',
            'apellido' => $_SESSION['apellido'] ?? '',
            'id' => $_SESSION['id'] ?? ''
        ]);
    }  
}

