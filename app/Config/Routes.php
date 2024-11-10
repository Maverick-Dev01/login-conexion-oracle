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


// Rutas para la gestión de clientes
$routes->get('/clientes', 'ClientesController::index');  // Muestra la lista de clientes
$routes->get('/clientes/crear', 'ClientesController::create');  // Muestra el formulario de creación de clientes
$routes->post('/clientes/guardar', 'ClientesController::store');  // Guarda el nuevo cliente
$routes->post('/clientes/eliminar', 'ClientesController::eliminar');  // Elimina clientes seleccionados
$routes->get('/clientes/ver/(:num)', 'ClientesController::show/$1');  // Muestra un cliente específico
$routes->get('/clientes/editar/(:num)', 'ClientesController::edit/$1');  // Muestra el formulario para editar un cliente
$routes->post('/clientes/update/(:num)', 'ClientesController::update/$1');  // Actualiza un cliente específico
$routes->post('/clientes/exportarCSV', 'ClientesController::exportarCSV');  // Exporta los clientes seleccionados a CSV
$routes->get('/clientes/exportToPDF', 'ClientesController::exportToPDF');  // Exporta todos los proyectos a PDF

// Rutas para la gestión de recursos empleados
$routes->get('/recursos_empleados', 'RecursoEmpleadoController::index');  // Muestra la lista de recursos empleados
$routes->get('/recursos_empleados/crear', 'RecursoEmpleadoController::create');  // Muestra el formulario de creación de recursos empleados
$routes->post('/recursos_empleados/guardar', 'RecursoEmpleadoController::store');  // Guarda el nuevo recurso empleado
$routes->post('/recursos_empleados/eliminar', 'RecursoEmpleadoController::eliminar');  // Elimina recursos empleados seleccionados
$routes->get('/recursos_empleados/ver/(:num)', 'RecursoEmpleadoController::show/$1');  // Muestra un recurso empleado específico
$routes->get('/recursos_empleados/editar/(:num)', 'RecursoEmpleadoController::edit/$1');  // Muestra el formulario para editar un recurso empleado
$routes->post('/recursos_empleados/update/(:num)', 'RecursoEmpleadoController::update/$1');  // Actualiza un recurso empleado específico
$routes->post('/recursos_empleados/exportarCSV', 'RecursoEmpleadoController::exportarCSV');  // Exporta los recursos empleados seleccionados a CSV


// Rutas para la gestión de reuniones
$routes->get('/reuniones', 'ReunionController::index');  // Muestra la lista de reuniones
$routes->get('/reuniones/crear', 'ReunionController::create');  // Muestra el formulario de creación de reuniones
$routes->post('/reuniones/guardar', 'ReunionController::store');  // Guarda la nueva reunión
$routes->post('/reuniones/eliminar', 'ReunionController::eliminar');  // Elimina reuniones seleccionadas
$routes->get('/reuniones/ver/(:num)', 'ReunionController::show/$1');  // Muestra una reunión específica
$routes->get('/reuniones/editar/(:num)', 'ReunionController::edit/$1');  // Muestra el formulario para editar una reunión
$routes->post('/reuniones/update/(:num)', 'ReunionController::update/$1');  // Actualiza una reunión específica
$routes->post('/reuniones/exportarCSV', 'ReunionController::exportarCSV');  // Exporta las reuniones seleccionadas a CSV

// Rutas para la gestión de tareas
$routes->get('/tareas', 'TareaController::index');  // Muestra la lista de tareas
$routes->get('/tareas/crear', 'TareaController::create');  // Muestra el formulario de creación de tareas
$routes->post('/tareas/guardar', 'TareaController::store');  // Guarda la nueva tarea
$routes->post('/tareas/eliminar', 'TareaController::eliminar');  // Elimina tareas seleccionadas
$routes->get('/tareas/ver/(:num)', 'TareaController::show/$1');  // Muestra una tarea específica
$routes->get('/tareas/editar/(:num)', 'TareaController::edit/$1');  // Muestra el formulario para editar una tarea
$routes->post('/tareas/update/(:num)', 'TareaController::update/$1');  // Actualiza una tarea específica
$routes->post('/tareas/exportarCSV', 'TareaController::exportarCSV');  // Exporta las tareas seleccionadas a CSV

//gráficos
$routes->get('/graficas', 'GraficasController::seleccion');
$routes->get('/graficas/proyectos', 'GraficasController::graficaProyectos');
$routes->get('/graficas/tareas', 'GraficasController::graficaTareas');
$routes->get('/graficas/exportar', 'GraficasController::exportarGrafica');

// Ruta para obtener datos JSON de proyectos para la gráfica
$routes->get('/graficas/datos/proyectos', 'GraficasController::getDatosProyectos');
$routes->get('/graficas/datos/tareas', 'GraficasController::getDatosTareas');


$routes->get('/graficas/recursos', 'GraficasController::graficaRecursos');
$routes->get('/graficas/datos/recursos', 'GraficasController::getDatosRecursos');









// Ruta adicional comentada para hashear contraseñas en la base de datos
// $routes->get('/hash-passwords', 'LoginController::hashExistingPasswords');

