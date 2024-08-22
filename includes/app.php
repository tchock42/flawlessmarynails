<?php
use Model\activeRecord;
require __DIR__ . '/../vendor/autoload.php';

require 'funciones.php';
require 'database.php';

ActiveRecord::setDB($db);