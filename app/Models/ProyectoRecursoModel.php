<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectoRecursoModel extends Model
{
    protected $table = 'PROYECTO_RECURSO';
    protected $primaryKey = 'ID_PROYECTO_RECURSO';
    protected $allowedFields = [
        'ID_RECURSO_EMPLEADO',
        'ID_PROYECTO',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertProyectoRecurso($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_P_RECURSO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_PROYECTO_RECURSO'] = $row->ID;
        return $this->insert($data);
    }
}
