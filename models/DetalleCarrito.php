<?php
namespace Model;

class DetalleCarrito extends ActiveRecord{
    protected static $tabla = 'detalles_carrito';
    protected static $columnasDB = ['id', 'id_carrito', 'id_producto', 'cantidad', 'precio_unitario', 'subtotal'];

    public $id;
    public $id_carrito;
    public $id_producto;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;

    public function __construct($args=[])
    {   
        $this->id = $args['id'] ?? null;
        $this->id_carrito = $args['id_carrito'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 1;
        $this->precio_unitario = $args['precio_unitario'] ?? '';
        $this->subtotal = $args['subtotal'] ?? '';
    }
}