<?php

namespace App\Models;

use CodeIgniter\Model;

class TareaModel extends Model
{
    protected $table = 'TAREA';
    protected $primaryKey = 'ID_TAREA';
    protected $allowedFields = [
        'NO_TAREA',
        'NOMBRE_TAREA',
        'DESCRIPCION',
        'LIDER',
        'FECHA_FIN',
        'FECHA_INICIO',
        'PRIORIDAD',
        'ESTADO_TAREA',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION',
        'ID_PROYECTO'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertTarea($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_TAREA.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_TAREA'] = $row->ID;
        return $this->insert($data);
    }
}
