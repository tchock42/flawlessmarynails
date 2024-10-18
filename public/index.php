<?php

require_once __DIR__ . '/../includes/app.php';  //accede a la base de datos

use MVC\Router;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\ProductosController;
use Controllers\CarritoController;

$router = new Router();

//area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/servicios', [PaginasController::class, 'servicios']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->get('/error', [PaginasController::class, 'error']);
$router->get('/productos', [PaginasController::class, 'productos']);
$router->get('/producto', [PaginasController::class, 'producto']);
$router->get('/tienda', [PaginasController::class, 'tienda']);
$router->get('/press-on', [PaginasController::class, 'presson']);

//iniciar sesion
$router->get('/login', [LoginController::class, 'login']);  //hacer login
$router->post('/login', [LoginController::class, 'login']); //post de login
$router->post('/logout', [LoginController::class, 'logout']);//logout
// $router->get('/crear', [LoginController::class, 'crear']);    //crear una cuenta
// $router->post('/crear', [LoginController::class, 'crear']);
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);
// $router->get('/mensaje', [LoginController::class, 'mensaje']);

$router->get('/cuenta-usuario', [LoginController::class, 'cuenta']);

// confirmacion de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

// API
$router->post('/api/carrito', [CarritoController::class, 'guardar']);       // url para datos de formData
$router->post('/api/producto', [CarritoController::class, 'almacenar']);    // url para datos de formData
$router->post('/api/eliminar', [CarritoController::class, 'eliminar']);     // url para eliminar del carrito
$router->post('/api/usuario', [CarritoController::class, 'usuario']);         // cargar usuario y carrito si existe

// area de administracion
$router->get('/admin', [ProductosController::class, 'index']);
$router->get('/productos/crear', [ProductosController::class, 'crear']);
$router->post('/productos/crear', [ProductosController::class, 'crear']);
$router->get('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductosController::class, 'eliminar']);
$router->comprobarRutas();