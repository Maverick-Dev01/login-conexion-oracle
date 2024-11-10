<?php

namespace App\Models;

use CodeIgniter\Model;

class ReunionModel extends Model
{
    protected $table = 'REUNION';
    protected $primaryKey = 'ID_REUNION';
    protected $allowedFields = [
        'NO_REUNION',
        'NOMBRE_REUNION',
        'DETALLES',
        'FECHA_COMIENZO',
        'HORA_COMIENZO',
        'AREA',
        'PLATAFORMA',
        'LINK',
        'ESTATUS_REUNION',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION',
        'ID_PROYECTO'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertReunion($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_REUNION.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_REUNION'] = $row->ID;
        return $this->insert($data);
    }
}
