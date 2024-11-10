<?php

namespace App\Models;

use CodeIgniter\Model;

class DomicilioModel extends Model
{
    protected $table = 'DOMICILIO';
    protected $primaryKey = 'ID_DOMICILIO';
    protected $allowedFields = [
        'CALLE',
        'NUMERO_EXTERIOR',
        'NUMERO_INTERIOR',
        'COLONIA',
        'CIUDAD',
        'ESTADO',
        'PAIS',
        'CODIGO_POSTAL',
        'FECHA_CREACION',
        'CREADO_POR',
        'FECHA_ACTUALIZACION',
        'ACTUALIZADO_POR'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertDomicilio($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_DOMICILIO.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_DOMICILIO'] = $row->ID;
        return $this->insert($data);
    }
}
