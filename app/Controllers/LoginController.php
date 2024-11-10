<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    public function index()
    {
        // Renderiza la vista del login
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UsuarioModel();

        $username = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        // Obtén el usuario por su nombre de usuario
        $user = $model->getUsuarioByUsername($username);

        if ($user) {
            // Verifica la contraseña usando password_verify
            if ($password === $user['CONTRASENIA']) {
                // Guarda la información del usuario en la sesión
                $session->set([
                    'id_usuario' => $user['ID_USUARIO'],
                    'usuario' => $user['USUARIO'],
                    'id_rol' => $user['ID_ROL'],
                    'logged_in' => true
                ]);
            
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Contraseña incorrecta.');
            }
            
        } else {
            // Usuario no encontrado
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

//     public function hashExistingPasswords()
// {
//     $db = \Config\Database::connect();
//     $usuarios = $db->query("SELECT * FROM USUARIO")->getResultArray();

//     foreach ($usuarios as $usuario) {
//         $hashedPassword = password_hash($usuario['CONTRASENIA'], PASSWORD_DEFAULT);
//         $db->query("UPDATE USUARIO SET CONTRASENIA = '$hashedPassword' WHERE id_usuario = " . $usuario['ID_USUARIO']);
//     }

//     echo "Contraseñas actualizadas correctamente.";
// }

}
