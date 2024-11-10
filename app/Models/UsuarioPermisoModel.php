<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioPermisoModel extends Model
{
    protected $table = 'USUARIO_PERMISO';
    protected $primaryKey = 'ID_RELACION';

    protected $allowedFields = ['ID_USUARIO', 'PERMISO_ID', 'ESTADO'];

    /**
     * Actualiza o inserta un permiso para un usuario específico.
     */
    public function actualizarPermisoUsuario($usuarioId, $permisoId, $estado)
    {
        $db = \Config\Database::connect();

        // Convierte el permiso ID en un entero
        $permisoId = intval($permisoId);

        $data = [
            'ID_USUARIO' => $usuarioId,
            'PERMISO_ID' => $permisoId,
            'ESTADO' => $estado
        ];

        $builder = $db->table('USUARIO_PERMISO');

        // Verificar si el permiso ya existe
        $builder->where('ID_USUARIO', $usuarioId)
            ->where('PERMISO_ID', $permisoId);

        if ($builder->countAllResults() > 0) {
            // Actualizar permiso existente
            $builder->update(['ESTADO' => $estado]);
        } else {
            // Generar el ID de relación con la secuencia y añadirlo a $data
            $query = $db->query("SELECT seq_id_relacion.NEXTVAL as ID_RELACION FROM DUAL");
            $row = $query->getRow();
            $data['ID_RELACION'] = $row->ID_RELACION;

            // Insertar nuevo permiso
            $builder->insert($data);
        }
    }


    public function updatePermisos()
    {
        $usuarioId = $this->request->getPost('usuario_id');
        $permisosSeleccionados = $this->request->getPost('permisos');

        $permisosModel = new PermisosModel();

        // Primero desactivar todos los permisos para el usuario
        $permisosModel->resetPermisos($usuarioId);

        // Actualizar permisos individuales
        foreach ($permisosSeleccionados as $permisoNombre) {
            $permisoId = $permisosModel->getPermisoIdByName($permisoNombre);
            $permisosModel->actualizarPermisoUsuario($usuarioId, $permisoId, 1);
        }

        return redirect()->to('/permisos')->with('success', 'Permisos actualizados correctamente.');
    }
}
