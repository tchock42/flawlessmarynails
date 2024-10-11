<?php
namespace Controllers;
use Model\Carrito;
use Model\Producto;
use Model\DetalleCarrito;

//guardar el carrito en la base de datos

class CarritoController{
    // creacion de carrito nuevo
    public static function guardar(){
        
        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $id_usuario = $_SESSION['id'];      //obtiene el id del usuario actual

        // Se busca si ya existe un carrito con el id_usuario actual
        $existeCarrito = Carrito::where('id_usuario', $id_usuario);
        if($existeCarrito){
            $respuesta = [
                'mensaje' => 'Existe un carrito',
                'id' => $existeCarrito->id      // extra el id del carrito
            ];
            $_SESSION['carrito'] = $respuesta['id'];
        }else{  // si la respuesta es null, no existe carrito
            $carrito = new Carrito($_POST);
            $carrito->id_usuario = $id_usuario;

            $respuesta = $carrito->guardar(); //retorna el resultado y id del carrito
            $_SESSION['carrito'] = $respuesta['id'];
        }
        
        echo json_encode($respuesta);
    }

    // creacion de detalle_producto
    public static function almacenar(){
        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $detalleCarrito = new DetalleCarrito($_POST);   // instancia de DetalleCarrito seleccionado por el usuario

        // verificacion de precios
        $id_producto = $detalleCarrito->id_producto;    // extrae el id del producto para verificar precio
        $verificaPrecio = Producto::where('id', $id_producto);

        if($verificaPrecio->precio !== $detalleCarrito->precio_unitario){
            $respuesta=[
                'mensaje' => 'El precio del producto seleccionado no es válido, inténtelo más tarde'
            ];
            echo json_encode($respuesta);
            return;
        }else{
            $resultado=$detalleCarrito->guardar();
        }

        

        if($resultado){
            echo json_encode([
                'resultado' => $resultado
            ]);
           
        }else{
            echo json_encode([
                'mensaje' => 'Hubo un problema al agregar tu producto al carrito'
            ]);
        }

        return;
    }

    // elimina el producto del
    public static function eliminar(){
        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $productoCarrito = DetalleCarrito::where('id_producto', $_POST['id_producto']);
        if($productoCarrito){
            $resultado = $productoCarrito->eliminar();

            echo json_encode([
                'resultado' => $resultado
            ]);
        }else{
            echo json_encode([
                'mensaje' => 'Hubo un error al eliminar el producto del carrito'
            ]);
        }
        return;
    }

    // obtiene el usuario y su carrito, si existe
    public static function usuario(){
        //detecta si hay una sesion abierta
        $usuario = $_SESSION;
        // echo json_encode([
        //     'respuesta' => $usuario
        // ]);
        
        if(!empty($usuario)){                   // si está iniciada la sesion
            $id_usuario = $_SESSION['id'];
            $carrito = Carrito::where('id_usuario', $id_usuario);
            
            if($carrito){               // si existe un carrito de este usuario
                $_SESSION['id_carrito'] = $carrito->id;     // guarda el id del carrito
                // echo json_encode([
                //     'respuesta' => 'usuario',
                //     'carrito' => $carrito 
                // ]);

                // consulta los productos del carrito
                $productos = DetalleCarrito::whereall('id_carrito', $carrito->id);
                
                if($productos){

                    echo json_encode([
                        'usuario' => $usuario,
                        'carrito' => $carrito,
                        'productos' => $productos
                    ]);
                }else{
                    echo json_encode([
                        'usuario' => $usuario,
                        'carrito' => $carrito,
                        'productos' => false
                    ]);
                }
                
            }else{
                echo json_encode([
                    'usuario' => $usuario,
                    'carrito' => false,
                    'productos' => false
                ]);
            }

        }else{
            echo json_encode([
                'usuario' => false,
                'carrito' => false,
                'productos' => false
            ]);
        }
        return;
    }
}  