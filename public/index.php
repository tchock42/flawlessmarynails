<?php

require_once __DIR__ . '/../includes/app.php';  //accede a la base de datos

use MVC\Router;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\ProductosController;

$router = new Router();

//area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/servicios', [PaginasController::class, 'servicios']);
$router->get('/contacto', [PaginasController::class, 'contacto']);

//iniciar sesion
$router->get('/login', [LoginController::class, 'login']);  //hacer login
$router->post('/login', [LoginController::class, 'login']); //post de login
$router->post('/logout', [LoginController::class, 'logout']);//logout
$router->get('/crear', [LoginController::class, 'crear']);    //crear una cuenta
$router->post('/crear', [LoginController::class, 'crear']);
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

$router->get('/cuenta-usuario', [LoginController::class, 'cuenta']);

// confirmacion de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

// tienda de press-on
$router->get('/productos', [PaginasController::class, 'productos']);


// area de administracion
$router->get('/admin', [ProductosController::class, 'index']);
$router->get('/productos/crear', [ProductosController::class, 'crear']);
$router->post('/productos/crear', [ProductosController::class, 'crear']);
$router->get('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductosController::class, 'eliminar']);
$router->comprobarRutas();