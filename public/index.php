<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\AdminController;
use Controllers\VendedoresController;
use Controllers\PaginaController;
use Controllers\AuthController;

$router = new Router();

$router->get('/', [PaginaController::class, 'Index']);
$router->get('/nosotros', [PaginaController::class, 'Nosotros']);
$router->get('/blog', [PaginaController::class, 'Blog']);
$router->get('/propiedades', [PaginaController::class, 'Propiedades']);
$router->get('/propiedad', [PaginaController::class, 'Propiedad']);
$router->get('/blog/entrada', [PaginaController::class, 'BlogEntrada']);
$router->get('/contacto', [PaginaController::class, 'Contacto']);
$router->post('/contacto', [PaginaController::class, 'Contacto']);

// Parte de iniciar sesion del sitio
$router->get('/iniciarsesion', [AuthController::class, 'Login']);
$router->post('/iniciarsesion', [AuthController::class, 'Login']);
$router->get('/cerrarsesion', [AuthController::class, 'Logout']);



// Zona Privada
// Parte administración del sitio
$router->get('/admin', [AdminController::class, 'Index']);

// Parte administración del sitio - parte propiedades
$router->get('/admin/propiedades', [PropiedadController::class, 'Index']);
$router->get('/admin/propiedades/crear', [PropiedadController::class, 'Crear']);
$router->post('/admin/propiedades/crear', [PropiedadController::class, 'Crear']);
$router->get("/admin/propiedades/actualizar", [PropiedadController::class, "Actualizar"]);
$router->post("/admin/propiedades/actualizar", [PropiedadController::class, 'Actualizar']);
$router->post('/admin/propiedades/eliminar', [PropiedadController::class, 'Eliminar']);

// Parte administración del sitio - parte vendedores
$router->get('/admin/vendedores', [VendedoresController::class, 'Index']);
$router->get('/admin/vendedores/crear', [VendedoresController::class, 'Crear']);
$router->post('/admin/vendedores/crear', [VendedoresController::class, 'Crear']);
$router->get('/admin/vendedores/actualizar', [VendedoresController::class, 'Actualizar']);
$router->post('/admin/vendedores/actualizar', [VendedoresController::class, 'Actualizar']);
$router->post('/admin/vendedores/eliminar', [VendedoresController::class, 'Eliminar']);


$router->comprobarRutas();

?>