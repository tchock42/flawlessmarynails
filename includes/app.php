<?php
use Dotenv\Dotenv;
use Model\activeRecord;
require __DIR__ . '/../vendor/autoload.php';

// adicion de Dotenv
$dotenv = Dotenv::createImmutable(__DIR__); // crea la global $_ENV
$dotenv->safeLoad();    // lee las variables de entorno

require 'funciones.php';
require 'database.php';

// Conexión a la base de datos
ActiveRecord::setDB($db);