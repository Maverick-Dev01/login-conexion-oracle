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


// Ruta adicional comentada para hashear contraseñas en la base de datos
// $routes->get('/hash-passwords', 'LoginController::hashExistingPasswords');

