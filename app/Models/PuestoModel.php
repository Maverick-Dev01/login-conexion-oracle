<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table = 'PUESTO';
    protected $primaryKey = 'ID_PUESTO';
    protected $allowedFields = [
        'NOMBRE_PUESTO',
        'DESCRIPCION',
        'FECHA_CREACION',
        'CREADO_POR',
        'FECHA_ACTUALIZACION',
        'ACTUALIZADO_POR'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertPuesto($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_PUESTO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_PUESTO'] = $row->ID;
        return $this->insert($data);
    }
}
