<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;

class UsuariosController extends Controller
{
    /**
     * Muestra la lista de todos los usuarios.
     */
    public function index()
    {
        // Crea una instancia del modelo UsuarioModel
        $usuarioModel = new UsuarioModel();
        // Obtiene todos los usuarios de la base de datos
        $data['usuarios'] = $usuarioModel->findAll();

        // Carga la vista 'usuarios/lista' pasando la información de los usuarios
        return view('usuarios/lista', $data);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Crea una instancia del modelo RolModel
        $rolModel = new RolModel();
        // Obtiene todos los roles de la base de datos
        $data['roles'] = $rolModel->findAll();

        // Carga la vista 'usuarios/crear' pasando la información de los roles
        return view('usuarios/crear', $data);
    }

    /**
    * Este método se encarga de recibir los datos del formulario de creación de usuarios
    * procesarlos, y luego guardarlos en la base de datos.     
    */
    public function store()
    {
        // Crea una instancia del modelo UsuarioModel
        $usuarioModel = new UsuarioModel();

        // Recoge los datos del formulario y los prepara para la inserción
        $data = [
            'ID_ROL' => $this->request->getPost('id_rol'),
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'TELEFONO' => $this->request->getPost('telefono'),
            'EMAIL' => $this->request->getPost('email'),
            'USUARIO' => $this->request->getPost('usuario'),
            // Hashea la contraseña antes de guardarla en la base de datos
            'CONTRASENIA' => password_hash($this->request->getPost('contrasenia'), PASSWORD_DEFAULT),
            'FECHA_CREACION' => date('Y-m-d H:i:s'),
        ];

        // Inserta el nuevo usuario en la base de datos utilizando el método insertUsuario del modelo
        $usuarioModel->insertUsuario($data);

        // Redirige a la lista de usuarios después de la inserción
        return redirect()->to('/usuarios');
    }
}
