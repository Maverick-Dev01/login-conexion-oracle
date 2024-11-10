<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::inicio');
$routes->get('/altaUsuario', 'Usuario::index');
$routes->get('/test', 'TestController::index');

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'DashboardController::index');

// Rutas para la gestión de usuarios
$routes->get('/usuarios', 'UsuariosController::index');  // Muestra la lista de usuarios
$routes->get('/usuarios/crear', 'UsuariosController::create');  // Muestra el formulario de creación de usuarios
$routes->post('/usuarios/guardar', 'UsuariosController::store');  // Guarda el nuevo usuario
$routes->post('/usuarios/eliminar', 'UsuariosController::eliminar');  // Elimina usuarios seleccionados
$routes->get('/usuarios/ver/(:num)', 'UsuariosController::show/$1');
$routes->get('/usuarios/editar/(:num)', 'UsuariosController::edit/$1');
$routes->post('/usuarios/update/(:num)', 'UsuariosController::update/$1');
$routes->post('/usuarios/exportarCSV', 'UsuariosController::exportarCSV');
$routes->get('/usuarios/exportToPDF', 'UsuariosController::exportToPDF');


//Rutas para los permisos
$routes->get('/permisos', 'PermisosController::index');
$routes->get('/permisos/getPermisos', 'PermisosController::getPermisos');
$routes->post('/permisos/updatePermisos', 'PermisosController::actualizarPermisos');


//Configuraciones


// Rutas para la gestión de proyectos
$routes->get('/proyectos', 'ProyectosController::index');  // Muestra la lista de proyectos
$routes->get('/proyectos/crear', 'ProyectosController::create');  // Muestra el formulario de creación de proyectos
$routes->post('/proyectos/guardar', 'ProyectosController::store');  // Guarda el nuevo proyecto
$routes->post('/proyectos/eliminar', 'ProyectosController::eliminar');  // Elimina proyectos seleccionados
$routes->get('/proyectos/ver/(:num)', 'ProyectosController::show/$1');  // Muestra un proyecto específico
$routes->get('/proyectos/editar/(:num)', 'ProyectosController::edit/$1');  // Muestra el formulario para editar un proyecto
$routes->post('/proyectos/update/(:num)', 'ProyectosController::update/$1');  // Actualiza un proyecto específico
$routes->post('/proyectos/exportarCSV', 'ProyectosController::exportarCSV');  // Exporta los proyectos seleccionados a CSV
$routes->get('/proyectos/exportToPDF', 'ProyectosController::exportToPDF');  // Exporta todos los proyectos a PDF

// Ruta adicional comentada para hashear contraseñas en la base de datos
// $routes->get('/hash-passwords', 'LoginController::hashExistingPasswords');

