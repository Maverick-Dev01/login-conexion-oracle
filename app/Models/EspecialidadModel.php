<?php

namespace App\Models;

use CodeIgniter\Model;

class EspecialidadModel extends Model
{
    protected $table = 'ESPECIALIDAD';
    protected $primaryKey = 'ID_ESPECIALIDAD';
    protected $allowedFields = [
        'NOMBRE_ESPECIALIDAD',
        'DESCRIPCION',
        'FECHA_CREACION',
        'CREADO_POR',
        'FECHA_ACTUALIZACION',
        'ACTUALIZADO_POR'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertEspecialidad($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_ESPECIALIDAD.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_ESPECIALIDAD'] = $row->ID;
        return $this->insert($data);
    }
}
