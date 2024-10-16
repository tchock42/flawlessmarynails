<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHpMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        try{
            // create a new object con la informacion de Brevo
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->Port = $_ENV['EMAIL_PORT'];

            $mail->setFrom('jacob.goca@outlook.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Confirma tu Cuenta';

            // Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<h1>¡Hola " . $this->nombre . "!</h1>";
            $contenido .= "<p>Has Registrado Correctamente tu cuenta en FlawlessMaryNails; pero es necesario confirmarla</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
            $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar este mensaje</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            //enviar email
            $mail->send();
        }catch(Exception $e){
            echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
    public function enviarInstrucciones(){

        try{
            // create a new object con la informacion de Brevo
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->Port = $_ENV['EMAIL_PORT'];

            $mail->setFrom('jacob.goca@outlook.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Recuperar Contraseña';

            // Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<h1>¡Hola " . $this->nombre . "!</h1>";
            $contenido .= "<p>Has solicitado reestablecer tu contraseña de Flawless Mary Nails, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] ."/reestablecer?token=" . $this->token . "'>Reestablecer contraseña</a>";       
            $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar este mensaje</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;

            //enviar email
            $mail->send();
        }catch(Exception $e){
            echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

}

