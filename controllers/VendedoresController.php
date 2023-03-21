<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;


class VendedoresController
{
    public static function Index(Router $router)
    {
        $vendedores = Vendedor::all();

        $resultado = $_SESSION['resultado'] ?? '';
        
        $router->render('/admin/vendedores/index', [
            "vendedores" => $vendedores,
            'resultado' => $resultado

        ]);
    }

    public static function Crear(Router $router)
    {
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor = new Vendedor($_POST['vendedor']);

            $errores = $vendedor->validar();

            // Revisar si el envio de errores este vacio
            if (empty($errores)) {
                // Crear la carpeta para subir imagenes
                $resultado = $vendedor->guardar();
                if ($resultado) {
                    // Redireccionar usuario
                    $_SESSION['resultado'] = "ok";
                    $_SESSION['mensaje'] = "Vendedor creado correctamente";
                    header('location:/admin/vendedores');
                } else {
                    $_SESSION['resultado'] = "error";
                    $_SESSION['mensaje'] = "Hubo un problema para crear el vendedor";
                    header("Location:/admin/vendedores");
                }
            }
        }


        $router->render('admin/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }


    public static function Actualizar(Router $router)
    {
        $msg = "El vendedor que intentas actualizar o eliminar no se encontro en la bd";
        $id = validarORedireccionar($msg, '/admin/vendedores');

        $vendedor = Vendedor::getById($id);
        $errores = Vendedor::getErrores();
        if(is_null($vendedor)){
             $_SESSION['resultado'] = "error";
             $_SESSION['mensaje'] = $msg;
 
             header('Location:/admin/vendedores');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva instancia
            $args = $_POST['vendedor'];
        
            $vendedor->sincronizar($args);
        
        
            $errores = $vendedor->validar();
        
            // Revisar si el envio de errores este vacio
            if (empty($errores)) {
        
                $resultado = $vendedor->guardar();

                if ($resultado) {
                    // Redireccionar usuario
                    $_SESSION['resultado'] = "ok";
                    $_SESSION['mensaje'] = "Vendedor actualizado correctamente";
                    header('location:/admin/vendedores');
                } else {
                    $_SESSION['resultado'] = "error";
                    $_SESSION['mensaje'] = "Hubo un problema para actualizar el vendedor";
                    header("Location:/admin/vendedores");
                }
            }
        }

        $router->render('admin/vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function Eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];


                if (validarTipoContenido($tipo)) {
                    // Obtener los datos de la propiedad 
                    $vendedor = Vendedor::getById($id);

                    $resultado = $vendedor->eliminar();

                    if ($resultado) {
                        // Redireccionar usuario
                        $_SESSION['resultado'] = "ok";
                        $_SESSION['mensaje'] = "Vendedor eliminado correctamente";
                        header('location:/admin/vendedores');
                    } else {
                        $_SESSION['resultado'] = "error";
                        $_SESSION['mensaje'] = "Hubo un problema para eliminar el vendedor";
                        header("Location:/admin/vendedores");
                    }
                }
            }
        }
    }

    
}
