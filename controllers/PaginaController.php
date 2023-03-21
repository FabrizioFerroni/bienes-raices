<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Model\Vendedor;
use PHPMailer\PHPMailer\PHPMailer;


class PaginaController
{
    public static function Index(Router $router)
    {
        $propiedad = Propiedad::get(3);
        $inicio = true;

        $router->render(
            '/pages/index',
            [
                'propiedades' => $propiedad,
                'inicio' => $inicio
            ]
        );
    }

    public static function Nosotros(Router $router)
    {
        $router->render('/pages/nosotros');
    }

    public static function Blog(Router $router)
    {
        $router->render('/pages/blog');
    }

    public static function BlogEntrada(Router $router)
    {
        $router->render('/pages/blogentrada');
    }

    public static function Propiedades(Router $router)
    {
        $propiedad = Propiedad::all();

        $router->render('/pages/propiedades', [
            'propiedades' => $propiedad
        ]);
    }

    public static function Propiedad(Router $router)
    {
        $slug = $_GET['slug'];
        $propiedad = Propiedad::getBySlug($slug);
        if (empty($slug) || $propiedad === NULL) {
            header("Location:/propiedades");
        }
        $router->render('/pages/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function Contacto(Router $router)
    {
        $mensaje = null;
        $mensaje_error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            try {
                //Configurar SMTP
                $mail->SMTPDebug = false;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '07f19faefaeb05';                     //SMTP username
                $mail->Password   = '7145e194340fdf';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Configurar el contenido del mail
                $mail->setFrom($respuestas['email'], $respuestas['nombre']);
                $mail->addAddress('admin@bienesraices.com', 'Admin - BienesRaices.com'); //Add a recipient

                $mail->Subject = 'Tienes una nueva consulta de tu sitio';

                //Habilitar HTML
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->CharSet = 'UTF-8';

                // Definir el contenido
                $contenido = '<html>';
                $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
                $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";
                $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
                $contenido .= "<p>Compra o Vende: " . $respuestas['opciones'] . "</p>";
                $contenido .= "<p>Presupuesto o Precio: $" . $respuestas['presupuesto'] . "</p>";

                if ($respuestas['contacto'] === 'telefono') {
                    $contenido .= "<p>Eligió ser contactado por teléfono:</p>";
                    $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] . " </p>";
                    $contenido .= "<p>El dia: " . $respuestas['fecha'] . " a las " . $respuestas['hora']  . " horas</p>";
                } else {
                    $contenido .= "<p>Eligio ser contactado por email:</p>";
                    $contenido .= "<p>Su email  es: " .  $respuestas['email'] . " </p>";
                }

                $contenido .= '</html>';

                $mail->Body = $contenido;
                $mail->AltBody = 'Esto es texto alternativo sin HTML';

                //  Enviar el email
                if ($mail->send()) {
                    $mensaje = 'Email enviado Correctamente';
                } else {
                    $mensaje_error = 'Hubo un Error... intente de nuevo';
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        $router->render('/pages/contacto', [
            'mensaje' => $mensaje,
            'mensaje_error' => $mensaje_error
        ]);
    }
}
