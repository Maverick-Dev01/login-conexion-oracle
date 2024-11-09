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
     * Este método se encarga de recibir los datos del formulario de creación de usuarios,
     * procesarlos, y luego guardarlos en la base de datos.
     */
    public function store()
    {
        // Crea una instancia del modelo UsuarioModel
        $usuarioModel = new UsuarioModel();

        // Recoge los datos del formulario y los prepara para la inserción
        $data = [
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'TELEFONO' => $this->request->getPost('telefono'),
            'EMAIL' => $this->request->getPost('email'),
            'USUARIO' => $this->request->getPost('usuario'),
            'CONTRASENIA' => password_hash($this->request->getPost('contrasenia'), PASSWORD_DEFAULT),
            'ID_ROL' => $this->request->getPost('id_rol'),
            // `NO_USUARIO` se generará automáticamente en el trigger
        ];

        // Inserta el nuevo usuario utilizando la función personalizada que maneja la secuencia
        if ($usuarioModel->insertUsuario($data)) {
            return redirect()->to('/usuarios')->with('success', 'Usuario creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el usuario.');
        }
    }

    /**
     * Elimina los usuarios seleccionados.
     */
    public function eliminar()
    {
        // Obtén los IDs de los usuarios seleccionados desde el formulario
        $usuariosIds = $this->request->getPost('usuarios');
        
        if (!empty($usuariosIds)) {
            $usuarioModel = new UsuarioModel();
            // Elimina los usuarios seleccionados
            $usuarioModel->whereIn('ID_USUARIO', $usuariosIds)->delete();
            
            // Redirige de vuelta a la lista de usuarios con un mensaje de éxito
            return redirect()->to('/usuarios')->with('success', 'Usuarios eliminados correctamente.');
        } else {
            // Si no se seleccionaron usuarios, muestra un mensaje de error
            return redirect()->to('/usuarios')->with('error', 'No se seleccionó ningún usuario.');
        }
    }
}
