<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;

/*El propósito de este controlador es gestionar la página principal (o "dashboard") 
 que se muestra a un usuario después de iniciar sesión, basada en su rol específico dentro del sistema.  */

class DashboardController extends Controller
{
    public function index()
    {
        // Inicia la sesión y obtiene el ID del usuario actualmente autenticado
        $session = session();
        $idUsuario = $session->get('id_usuario'); // se queda en mayusculas, esto porque en el controlador login,así está, sino, la sesión no inicia

        if (!$idUsuario) {
            log_message('error', 'ID_USUARIO no encontrado en la sesión.');
            return redirect()->to('/login')->with('error', 'Sesión no iniciada.');
        }

        // Crea una instancia del modelo UsuarioModel para interactuar con la tabla de usuarios
        $usuarioModel = new UsuarioModel();
        // Busca al usuario en la base de datos utilizando el ID del usuario (en mayúsculas)
        $usuario = $usuarioModel->find($idUsuario);

        // Si el usuario no es encontrado, redirige al formulario de login con un mensaje de error
        if (!$usuario) {
            log_message('error', 'Usuario con ID ' . $idUsuario . ' no encontrado.');
            return redirect()->to('/login')->with('error', 'Usuario no encontrado.');
        }

        // Crea una instancia del modelo RolModel para interactuar con la tabla de roles
        $rolModel = new RolModel();
        // Busca el rol del usuario en la base de datos usando el ID del rol (en mayúsculas)
        $rol = $rolModel->find($usuario['ID_ROL']);

        if (!$rol) {
            log_message('error', 'Rol con ID ' . $usuario['ID_ROL'] . ' no encontrado.');
            return redirect()->to('/login')->with('error', 'Rol no encontrado.');
        }

        // Guarda el nombre del rol en la sesión para un acceso más fácil
        $session->set('ROL', $rol['NOMBRE_ROL']);

        // Redirige al usuario a la vista correspondiente según su rol
        switch ($usuario['ID_ROL']) {
            case 1:
                return view('admin_home');
            case 2:
                return view('pmo_home');
            case 3:
                return view('consultor_home');
            default:
                log_message('error', 'Rol no identificado: ' . $usuario['ID_ROL']);
                return redirect()->to('/login')->with('error', 'Rol no identificado.');
        }
    }
}
