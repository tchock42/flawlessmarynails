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
    public static function producto(Router $router){

        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /productos');
        }

        $producto=Producto::find($id);

        if(!$producto){
            header('Location: /productos');
        }
        $router->render('paginas/producto', [
            'producto' => $producto,
            'titulo' => $producto->nombre 
        ]);
    }
    public static function error(Router $router){

        $router->render('paginas/error',[
            'titulo' => 'Error 404'
        ]);
    }
    public static function tienda(Router $router){
        
        $router->render('paginas/tienda', [
            'titulo' => 'Tienda'
        ]);
    }
}

