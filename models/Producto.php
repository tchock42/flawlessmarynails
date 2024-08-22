<?php
// modelos de active record para acceder a la tabla de productos
namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'precio', 'imagen', 'disponibilidad'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->disponibilidad = $args['disponibilidad'] ?? 1;
    }

    public function validar(){
        // validaciones para el formulario de nuevo producto
        if(!$this->nombre){ //revisa que el arreglo este vacío
            self::$alertas['error'][] = "Debes escribir un titulo para el set";
        }
        if(strlen($this->descripcion) < 50 ){
            self::$alertas['error'][] = "El campo de descripción es obligatorio y debe tener al menos 50 caracteres";
        }
        if(!$this->precio){
            self::$alertas['error'][] = "El campo de precio es obligatorio";
        }
        if(!$this->imagen){
            self::$alertas['error'][] = "La imagen del set de uñas es obligatoria";
        }
        //ya no es necesario validar el tamaño de la imagen por el resizing que se hizo
        return self::$alertas;
    }
}