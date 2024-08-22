<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;
class LoginController{

    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarLogin();
           
            if(empty($alertas)){
                //verificar que el usuario existe

                $usuario = Usuario::where('email', $usuario->email);
                // debuguear($usuario);
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El correo que ingresaste no existe o no está confirmado');
                    //TO DO
                }else{
                    //el usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;

                        //Redireccion
                        if($usuario->admin){
                            header('Location: /admin');
                        }else{
                            header('Location: /');
                        }

                    } else {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $router->render('auth/login', [
            'titulo' => 'Inicio',
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router){

        $alertas = [];                              // alertas vacío
        $usuario = new Usuario;                     // crea instancia de usuario

        if($_SERVER['REQUEST_METHOD']  === 'POST'){ 
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_cuenta();
            debuguear($alertas);
            
            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);  // revisa si ya existe el email en bd
                
                if($existeUsuario){
                    Usuario::setAlerta('error', 'Ya existe un usuario registrado con ese correo electrónico');
                    $alertas = Usuario::getAlertas();
                }else{
                    $usuario->hashPassword();   //hashear password
                    
                    unset($usuario->password2);

                    $usuario->crearToken();

                    // debuguear($usuario);
                    $resultado = $usuario->guardar();

                    //Enviar email de confirmacion
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token); // crea instancia de Email
                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }          

            }
        }

        $router->render('auth/crear', [
            'titulo' => 'Crear cuenta en Flawless Mary Nails',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            // debuguear($auth);
            $alertas = $auth->validarEmail();
            // debuguear($alertas);

            if(empty($alertas)){ //si el usuario teclea un correo
                $usuario = Usuario::where('email', $auth->email); // busca en columna email el valor de auth
                // debuguear($usuario);
                if($usuario && $usuario->confirmado === "1"){
                    //Generar un token
                    $usuario->crearToken(); //asigna un nuevo token al usuario
                    unset($usuario->password2);
                    // debuguear($usuario); 
                    $usuario->guardar(); //realiza un update en la base de datos

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token); //construct($nombre, $email, $token
                    
                    $email->enviarInstrucciones(); //mandar correo con instrucciones
                    //Alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu email');
                    // $alertas = Usuario::getAlertas();
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado'); //agrega un error
                    // $alertas = Usuario::getAlertas(); //recupera el error
                }
            }
        }
        //se obtienen las alertas del if y del else anterior
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'titulo' => 'Reestablecer Contraseña',
            'alertas' => $alertas,
        ]);
    }
    public static function reestablecer(Router $router){
        
        $alertas = [];
        $token = s($_GET['token']);
        $token_valido = true;

        // if(!$token) header('Location: /');

        //Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no Válido, inténtalo de nuevo');
            $token_valido = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            // Añadir el nuevo password
            $password = new Usuario($_POST);
            // debuguear($password);
            $alertas = $password->validarPassword();
            if(empty($alertas)){ //se copia la nueva contraseña al objeto $usuario
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword(); //metodo solo se usa con clase Usuario
                $usuario->token = null;
                unset($usuario->password2);
                // debuguear($usuario);
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/reestablecer', [
            'titulo' => 'Crear nueva contraseña',
            'alertas' => Usuario::getAlertas(),
            'token_valido' => $token_valido
        ]);
    }
    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }
    public static function confirmar(Router $router){

        $token = s($_GET['token']);             // obtiene el token del query string y lo valida
        if(!$token) header('Location: /');
        
        //encontrar al usuario
        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)){
            $titulo = 'Token Inválido';
            Usuario::setAlerta('error', 'Token no válido, la cuenta no se confirmó. Intenta registrarte correctamente con un correo electrónico válido.');
            
        }else{
            //confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);

            //Guardar en la bd
            $usuario->guardar();
            $titulo = 'Cuanta confirmada';
            Usuario::setAlerta('exito', 'Tu cuenta en Flawless Mary Nails ha sido confirmada. Ahora puedes iniciar sesión.:)');
        }

        $router->render('auth/confirmar', [
            'titulo' => $titulo,
            'alertas' => Usuario::getAlertas()
        ]);
    }
    public static function logout(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }

    public static function cuenta(Router $router){

        $router->render('auth/cuenta', [
            'titulo' => 'Cuenta de usuario'
        ]);
    }
}
