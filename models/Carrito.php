<?php
namespace Model;

class Carrito extends ActiveRecord{
    
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'id_usuario', 'fecha', 'estado'];

    public $id;
    public $id_usuario;
    public $fecha;
    public $estado;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}