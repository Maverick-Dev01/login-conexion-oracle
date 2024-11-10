<?php

namespace App\Models;

use CodeIgniter\Model;

class SeguimientoModel extends Model
{
    protected $table = 'SEGUIMIENTO';
    protected $primaryKey = 'ID_SEGUIMIENTO';
    protected $allowedFields = [
        'ID_TAREA',
        'ID_REUNION',
        'ID_RECURSO_EMPLEADO',
        'AVANCE_TOTAL',
        'AREA',
        'ESTADO',
        'FECHA_INICIO',
        'FECHA_FIN',
        'HORAS_REALES',
        'HORAS_ESTIMADAS',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertSeguimiento($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_SEGUIMIENTO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_SEGUIMIENTO'] = $row->ID;
        return $this->insert($data);
    }
}
