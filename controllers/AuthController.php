<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Model\Admin;


class AuthController
{
    public static function Login(Router $router)
    {
        $login = true;
        // $errores = [];
        $errores = Admin::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar el usuario
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('/auth/login', [
            'login' => $login,
            'errores' => $errores
        ]);
    }

    public static function Logout(Router $router)
    {
        session_start();
        session_destroy();
        header("Location:/");
    }
}
