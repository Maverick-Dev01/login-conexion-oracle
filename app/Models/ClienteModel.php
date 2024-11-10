<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'CLIENTE';
    protected $primaryKey = 'ID_CLIENTE';
    protected $allowedFields = [
        'NO_CLIENTE',
        'RAZON_SOCIAL',
        'NOMBRE_COMERCIAL',
        'GIRO',
        'RFC',
        'NOMBRE_REPRESENTANTE',
        'TELEFONO_REPRESENTANTE',
        'STATUS_CLIENTE',
        'FECHA_CREACION',
        'ACTUALIZADO_POR',
        'FECHA_ACTUALIZACION',
        'ID_DOMICILIO'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function insertCliente($data)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SEQ_ID_CLIENTE.NEXTVAL AS ID FROM DUAL");
        $row = $query->getRow();
        $data['ID_CLIENTE'] = $row->ID;
        return $this->insert($data);
    }
}
