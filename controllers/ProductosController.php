<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

// clase para la generación de cita
class ProductosController{

    public static function index(Router $router){ //pagina principal de administrador
        
        if(!is_admin()){
            header('Location: /login');
        }
        // debuguear($_SESSION);
        $productos = Producto::all();
        // debuguear($productos);
        $router->render('productos/admin', [
            'titulo' => 'Administracion de productos',
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router){

        $producto = new Producto;                   // crea un producto vacío
        $alertas = [];                              // alertas vacío

        if(!is_admin()){
            header('Location: /login');
        }

        if( $_SERVER["REQUEST_METHOD"] === 'POST'){

            if(!is_admin()){
                header('Location: /login');
            }
            // deteccion de la imagen
            if( $_FILES['imagen']['tmp_name'] ){ //si la imagen cargó
                $carpeta_imagenes = '../public/imagenes/';  // carpeta destino

                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }
                //genera un resize y corte,calidad de 80, en imagen png y webp. no guarda aun
                $manager = new ImageManager(Driver::class);
                $image_webp = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->encode(new WebpEncoder(quality:80));
                $image_jpg = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800);
                
                //este es el nombre del archivo
                $nombreImagen = md5( uniqid( rand(), true)); //md5 crea un string, se puede concatenar
                //agregar el nombre al POST
                $_POST['imagen'] = $nombreImagen;
                
            }
            $producto->sincronizar($_POST);
            // debuguear($producto);
            //validar 
            $alertas = $producto->validar();

            //Revisar que el arreglo de errores esté vacío con la funcion
            if(empty($alertas)){ //si está vacío, no hay errores e inserta en la base de datos

                //Guarda la imagen en elservidor
                $image_jpg->save($carpeta_imagenes . '/' . $nombreImagen . ".jpeg");          
                $image_webp->save($carpeta_imagenes . '/' . $nombreImagen . ".webp");
                //Guarda en la basede datos
                $resultado=$producto->guardar();   
                if($resultado){
                    header('Location: /admin');
                }        
            }
        }


        $router->render('productos/crear', [
            'titulo' => 'Creación de producto',
            'alertas' => $alertas,
            'producto' => $producto
        ]);
    }

    public static function actualizar(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }

        $alertas = [];

        $id =$_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /admin');
        }
        //buscar el producto
        $producto = Producto::find($id);
        
        if(!$producto){
            header('Location: /admin');
        }

        //respaldar la imagen
        $producto->imagen_actual = $producto->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){ //si se presiona guardar cambios
            if(!is_admin()){ //revisa si es admin
                header('Location: /login');
            } 

            // deteccion de la imagen
            if( $_FILES['imagen']['tmp_name'] ){ //si la imagen cargó
                $carpeta_imagenes = '../public/imagenes/';  // carpeta destino

                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }
                //elimina la imagen anterior
                unlink($carpeta_imagenes . '/' . $producto->imagen_actual . ".jpeg");
                unlink($carpeta_imagenes . '/' . $producto->imagen_actual . ".webp");
                //genera un resize y corte,calidad de 80, en imagen png y webp. no guarda aun
                $manager = new ImageManager(Driver::class);
                $image_webp = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->encode(new WebpEncoder(quality:80));
                $image_jpg = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800);
                
                //este es el nombre del archivo
                $nombreImagen = md5( uniqid( rand(), true)); //md5 crea un string, se puede concatenar
                //agregar el nombre al POST
                $_POST['imagen'] = $nombreImagen;   
            }else{
                $_POST['imagen'] = $producto->imagen_actual; //se vuelve a asignar la imagen original al post
            }

            $producto->sincronizar($_POST); 

            $alertas = $producto->validar();
            if(empty($alertas)){ //si no hay alertas
                if(isset($nombreImagen)){ //si se creó el nombre de la imagen
                    //se tienen que guardar fisicamente en carpeta speakers
                    $image_jpg->save($carpeta_imagenes . '/' . $nombreImagen . ".jpeg");
                    $image_webp->save($carpeta_imagenes . '/' . $nombreImagen . ".webp");
                }
                
                $resultado = $producto->guardar();
                if($resultado){
                    header('Location: /admin');
                }
            }
        }

        $router->render('productos/actualizar', [
            'titulo' => 'Actualización de producto',
            'alertas' => $alertas,
            'producto' => $producto
        ]);
    }
    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if(!is_admin()){ //revisa si es admin
                header('Location: /login');
            } 
            $id = $_POST['id'];
            $producto = Producto::find($id);
            if(!isset($producto)){
                header('Location: /admin');
            }
            $carpeta_imagenes = '../public/imagenes'; //selecciona carpeta destino
            unlink($carpeta_imagenes . '/' . $producto->imagen . ".jpeg");
            unlink($carpeta_imagenes . '/' . $producto->imagen . ".webp");
            $resultado = $producto->eliminar(); //elimina el ponente de la base de datos
            if($resultado){
                header('Location: /admin');
            }
        }
    }
}