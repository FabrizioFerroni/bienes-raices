<?php

namespace Controllers;

use MVC\Router;

class AdminController
{
    public static function Index(Router $router)
    {
        $resultado = $_SESSION['resultado'] ?? '';

        $router->render('/admin/index', [
            'resultado' => $resultado
        ]);
    }
}
