<?php

namespace App\Controllers; 

use App\Models\UsuarioModel; 
use CodeIgniter\Controller;

// El propósito principal de este controlador es manejar las operaciones relacionadas con el inicio de sesión de los usuarios, 
// como la autenticación, el cierre de sesión, y también (aunque está comentado) la actualización de las contraseñas en la base de datos.
class LoginController extends Controller
{
    public function index()
    {
        // Renderiza la vista del login
        return view('login');
    }

    public function authenticate()
    {
        $session = session(); // se inicializa una sesión
        $model = new UsuarioModel(); // se crea la instancia del modelo, para interactuar con la base de datos

        //Obtención de datos: Se obtienen los valores enviados en el 
        //formulario de inicio de sesión (usuario y contraseña).
        $username = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        // se hace una busqueda en la base de datos utilizando el nombre de usuario
        $user = $model->getUsuarioByUsername($username);

        if ($user) { // si el usuario se encuentra, entonces
            // Verifica la contraseña usando password_verify
            if (password_verify($password, $user['CONTRASENIA'])) {//compara la contraseña ingresada con la almacenada (previamente hasheada).
                // Guarda la información del usuario en la sesión
                $session->set([
                    'id_usuario' => $user['ID_USUARIO'],
                    'usuario' => $user['USUARIO'],
                    'id_rol' => $user['ID_ROL'],
                    'logged_in' => true
                ]);
                //si la verificación es exitosa, lo redirige a la vista dashboard
                return redirect()->to('/dashboard');
            } else {// en caso contrario, lo deja en la misma vista y le indica el error, si es la contraseña
                return redirect()->back()->with('error', 'Contraseña incorrecta.');
            }
            
        } else {
            // Usuario no encontrado
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
    }

    public function logout()// función para cerrar la sesión del usuario, lo redirige a la vista login
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
