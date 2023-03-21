<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function Index(Router $router)
    {
        $propiedades = Propiedad::all();

        // Ver temas sesiones cuando haga parte del login
        // session_start();

        $resultado = $_SESSION['resultado'] ?? '';
        // debug($_SESSION);

        // debug($resultado);
        $router->render('/admin/propiedades/index', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function Crear(Router $router)
    {
        $errores = Propiedad::getErrores();
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar nombre unico
            $extension = pathinfo($_FILES['propiedad']['name']['imagen'], PATHINFO_EXTENSION);
            $nombreImagen = md5(uniqid(rand(), true)) . "." . $extension;

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // Realiza un resize a la imagen con intervetion
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validar();

            // Revisar si el envio de errores este vacio
            if (empty($errores)) {
                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMG)) {
                    mkdir(CARPETA_IMG);
                }

                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMG . $nombreImagen);

                $resultado = $propiedad->guardar();
                if ($resultado) {
                    // Redireccionar usuario
                    $_SESSION['resultado'] = "ok";
                    $_SESSION['mensaje'] = "Anuncio creado correctamente";
                    header('location:/admin/propiedades');
                } else {
                    $_SESSION['resultado'] = "error";
                    $_SESSION['mensaje'] = "Hubo un problema para crear el anuncio";
                    header("Location:/admin/propiedades");
                }
            }
        }


        $router->render('admin/propiedades/crear', [
            'errores' => $errores,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]);
    }

    public static function Actualizar(Router $router)
    {
        $msg = "El anuncio que intentas actualizar o eliminar no se encontro en la bd";
        $id = validarORedireccionar($msg, '/admin/propiedades');

        $propiedad = Propiedad::getById($id);

        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if (is_null($propiedad)) {
            $_SESSION['resultado'] = "error";
            $_SESSION['mensaje'] = $msg;
            header('Location:/admin/propiedades');
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['propiedad'];
            $args['slug'] = slugify($args['titulo']);

            $propiedad->sincronizar($args);

            // Validacion
            $errores = $propiedad->validar();

            // Subida de archivos 
            // Generar nombre unico
            $extension = pathinfo($_FILES['propiedad']['name']['imagen'], PATHINFO_EXTENSION);
            $nombreImagen = md5(uniqid(rand(), true)) . "." . $extension;

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // Realiza un resize a la imagen con intervetion
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                $propiedad->setImagen($nombreImagen);
            }

            // Revisar si el envio de errores este vacio
            if (empty($errores)) {
                // Almacenar imagen 
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMG . $nombreImagen);
                }
                // Guardar en la base de datos
                $resultado = $propiedad->guardar();

                if ($resultado) {
                    // Redireccionar usuario
                    $_SESSION['resultado'] = "ok";
                    $_SESSION['mensaje'] = "Anuncio actualizado correctamente";
                    header('location:/admin/propiedades');
                } else {
                    $_SESSION['resultado'] = "error";
                    $_SESSION['mensaje'] = "Hubo un problema para actualizar el anuncio";
                    header("Location:/admin/propiedades");
                }
            }
        }

        $router->render('admin/propiedades/actualizar', [
            'errores' => $errores,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
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
                    $propiedad = Propiedad::getById($id);

                    $resultado = $propiedad->eliminar();

                    if ($resultado) {
                        // Redireccionar usuario
                        $_SESSION['resultado'] = "ok";
                        $_SESSION['mensaje'] = "Anuncio eliminado correctamente";
                        header('location:/admin/propiedades');
                    } else {
                        $_SESSION['resultado'] = "error";
                        $_SESSION['mensaje'] = "Hubo un problema para eliminar el anuncio";
                        header("Location:/admin/propiedades");
                    }
                }
            }
        }
    }
}
