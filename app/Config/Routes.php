<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio','Home::inicio');
$routes->get('/altaUsuario','usuario::index');
$routes->get('/test', 'TestController::index');
$routes->get('/usuarios', 'UsuarioController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/usuarios', 'UsuariosController::index');
$routes->get('/usuarios/crear', 'UsuariosController::create');
$routes->post('/usuarios/guardar', 'UsuariosController::store');



//Al acceder esta ruta se ejectua la función para hasehar las contraseñas existentes en la base de datos
//$routes->get('/hash-passwords', 'LoginController::hashExistingPasswords');

