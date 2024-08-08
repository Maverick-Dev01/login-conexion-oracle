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

