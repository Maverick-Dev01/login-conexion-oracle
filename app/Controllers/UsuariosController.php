<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;

class UsuariosController extends Controller
{
    // Muestra la lista de usuarios
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $query = $this->request->getGet('query');
        
        $usuarios = $query
            ? $usuarioModel->like('NOMBRE', $query)->orLike('APELLIDO_PATERNO', $query)->orLike('EMAIL', $query)->findAll()
            : $usuarioModel->findAll();

        return view('usuarios/lista', ['usuarios' => $usuarios, 'query' => $query]);
    }

    public function create()
    {
        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();
        return view('usuarios/crear', $data);
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'NOMBRE' => $this->request->getPost('nombre'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
            'TELEFONO' => $this->request->getPost('telefono'),
            'EMAIL' => $this->request->getPost('email'),
            'USUARIO' => $this->request->getPost('usuario'),
            'CONTRASENIA' => password_hash($this->request->getPost('contrasenia'), PASSWORD_DEFAULT),
            'ID_ROL' => $this->request->getPost('id_rol'),
        ];

        if ($usuarioModel->insertUsuario($data)) {
            return redirect()->to('/usuarios')->with('success', 'Usuario creado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el usuario.');
        }
    }

    // Muestra un usuario específico
    public function show($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('usuarios/ver', ['usuario' => $usuario]);
    }

    // Muestra el formulario para editar un usuario
    public function edit($id)
    {
        $usuarioModel = new UsuarioModel();
        $rolModel = new RolModel();

        $usuario = $usuarioModel->find($id);
        $roles = $rolModel->findAll();

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('usuarios/editar', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function update($id)
{
    $usuarioModel = new UsuarioModel();

    $data = [
        'NOMBRE' => $this->request->getPost('nombre'),
        'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
        'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
        'TELEFONO' => $this->request->getPost('telefono'),
        'EMAIL' => $this->request->getPost('email'),
        'USUARIO' => $this->request->getPost('usuario'),
        'ID_ROL' => $this->request->getPost('id_rol'),
    ];

    if ($usuarioModel->update($id, $data)) {
        return redirect()->to('/usuarios')->with('success', 'Usuario actualizado correctamente.');
    } else {
        return redirect()->back()->with('error', 'Error al actualizar el usuario.');
    }
}


    // Elimina los usuarios seleccionados
    public function eliminar()
    {
        $usuariosIds = $this->request->getPost('usuarios');
        
        if (!empty($usuariosIds)) {
            $usuarioModel = new UsuarioModel();
            $usuarioModel->whereIn('ID_USUARIO', $usuariosIds)->delete();
            return redirect()->to('/usuarios')->with('success', 'Usuarios eliminados correctamente.');
        } else {
            return redirect()->to('/usuarios')->with('error', 'No se seleccionó ningún usuario.');
        }
    }

    // Exporta los usuarios a un archivo CSV
    public function exportar()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $this->request->getPost('usuarios')
            ? $usuarioModel->whereIn('ID_USUARIO', $this->request->getPost('usuarios'))->findAll()
            : $usuarioModel->findAll();

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=usuarios.csv");
        $output = fopen("php://output", "w");

        fputcsv($output, array('ID_USUARIO', 'NO_USUARIO', 'NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'TELEFONO', 'EMAIL', 'USUARIO', 'ROL'));
        foreach ($usuarios as $usuario) {
            fputcsv($output, $usuario);
        }

        fclose($output);
        exit;
    }
}
