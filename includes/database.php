<?php

$db = mysqli_connect('localhost','root', 'master42', 'flawlessmarynails');

$db->set_charset('utf8');

if(!$db){
    echo "Error: No se pudo conectar a MySQL.";
    echo "error de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
// /*codigo para crear un usuario*/
// $email = "membrillomary@gmail.com";
// $password = "jacob901116";
// $passwordHash = password_hash($password, PASSWORD_DEFAULT);
// // var_dump($passwordHash);
// //query para crear el usuario
// $query = "INSERT INTO usuarios (nombre, apellido, email, telefono, password, admin, confirmado) VALUES ('Mary', 'Membrillo', '$email', '5532896180', '$passwordHash', 1, 1); ";
// // debuguear($query);

// mysqli_query($db, $query);
// /*Termina creación de usuario */
// return $db;