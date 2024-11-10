<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermisosModel;
use App\Models\UsuarioModel;
use App\Models\UsuarioPermisoModel;

class PermisosController extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $permisosModel = new PermisosModel();
        
        // Cargar todos los usuarios y permisos
        $usuarios = $usuarioModel->findAll();
        $permisos = $permisosModel->getPermisos();

        return view('permisos/index', [
            'usuarios' => $usuarios,
            'permisos' => $permisos
        ]);
    }

    public function getPermisos()
    {
        $usuarioId = $this->request->getGet('usuario_id');

        $permisosModel = new PermisosModel();
        $usuarioPermisoModel = new UsuarioPermisoModel();

        $permisos = $permisosModel->getPermisos();
        $estadoPermisos = [];

        foreach ($permisos as $permiso) {
            $estadoPermisos[$permiso['ID_PERMISO']] = $usuarioPermisoModel
                ->where('ID_USUARIO', $usuarioId)
                ->where('PERMISO_ID', $permiso['ID_PERMISO'])
                ->first()['ESTADO'] ?? 0;
        }

        return view('permisos/usuario_permisos', [
            'usuarioId' => $usuarioId,
            'permisos' => $permisos,
            'estadoPermisos' => $estadoPermisos
        ]);
    }

    public function actualizarPermisos()
    {
        $usuarioId = $this->request->getPost('usuario_id');
        $permisosSeleccionados = $this->request->getPost('permisos');
    
        $usuarioPermisoModel = new UsuarioPermisoModel();
    
        // Asegúrate de que el arreglo de permisos contiene IDs numéricos
        foreach ($permisosSeleccionados as $permisoId => $estado) {
            // Convierte el permiso ID en un entero
            $permisoId = intval($permisoId);
            $usuarioPermisoModel->actualizarPermisoUsuario($usuarioId, $permisoId, $estado);
        }
    
        return redirect()->to('/permisos')->with('success', 'Permisos actualizados correctamente.');
    }
    
}
